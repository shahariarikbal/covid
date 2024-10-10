<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VaccineRegisterRequest;
use App\Services\VaccineServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class VaccineRegistrationController extends Controller
{
    public function store(VaccineRegisterRequest $request, VaccineServices $vaccineServices)
    {
        try{
            $result = $vaccineServices->store($request);
            return redirect()->back()->withSuccess('Your registration has been successfull');
        }catch(ModelNotFoundException $exception){
            return redirect()->back()->withError($exception->getMessage());
        }
    }
}
