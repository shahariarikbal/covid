<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vaccination;
use App\Models\VaccineCenter;


class FrontendController extends Controller
{
    public function index()
    {
        $vaccineCenters = VaccineCenter::all();
        return view('frontend.home.index', compact('vaccineCenters'));
    }

    public function VaccineList()
    {
        $search = request()->search;

        $getPatient = Vaccination::where('nid', $search)->first();
        return view('frontend.pages.vaccine-list', compact('getPatient'));
    }
}
