<?php

namespace App\Services;

use App\Constants\Status;
use App\Models\Vaccination;
use App\Models\VaccineCenter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VaccineServices
{
     public function store($request)
     {
          // Get the center and today's registration count
          $center = $this->getVaccineCenter($request->center_id);
          $todayRegistrations = $this->getTodayRegistrations($request->center_id, $request->vaccine_date);

          // Determine the vaccine date (either the requested date or the next available day)
          $vaccineDate = $this->determineVaccineDate($center, $todayRegistrations, $request->vaccine_date);

          // Create the vaccination record
          return $this->createVaccination($request, $vaccineDate);
     }

    private function getVaccineCenter($centerId)
    {
        return VaccineCenter::findOrFail($centerId);
    }

    private function getTodayRegistrations($centerId, $vaccineDate)
    {
        return Vaccination::where('center_id', $centerId)
            ->whereDate('vaccine_date', Carbon::parse($vaccineDate))
            ->count();
    }

    private function determineVaccineDate($center, $todayRegistrations, $requestedDate)
    {
        // Convert the requested date to a Carbon instance
        $vaccineDate = Carbon::parse($requestedDate);

        // If the limit is reached, find the next available date starting from the requested date
        if ($todayRegistrations >= $center->daily_limit) {
            return $this->findNextAvailableDate($center->id, $vaccineDate->addDay());
        }

        // Otherwise, use the requested date
        return $vaccineDate;
    }

    private function findNextAvailableDate($centerId, $date)
    {
        $center = $this->getVaccineCenter($centerId);
        
        // Get the count of registrations for the given date
        $dateRegistrations = Vaccination::where('center_id', $centerId)
            ->whereDate('vaccine_date', $date)
            ->count();

        // If the registration count is less than the limit, return the date
        if ($dateRegistrations < $center->daily_limit) {
            return $date;
        }

        // Recursively check the next day
        return $this->findNextAvailableDate($centerId, $date->addDay());
    }

    private function createVaccination($request, $vaccineDate)
    {
        // Determine the status based on whether the date is today or future
        $status = $vaccineDate->isToday() ? Status::SCHEDULED : Status::NOTSCHEDULED;

        return Vaccination::create([
            'center_id' => $request->center_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'nid' => $request->nid,
            'email' => $request->email,
            'vaccine_date' => $vaccineDate,
            'phone' => $request->phone,
            'status' => $status,
        ]);
    }
}