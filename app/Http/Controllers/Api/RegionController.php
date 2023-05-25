<?php

namespace App\Http\Controllers\Api;

use App\Models\Regency;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function getProvinces(){
        $provinces = Province::all();
        return ResponseHelper::responseJson("Success",200,"List Provinces",$provinces);
    }

    public function getRegencies(Request $request){
        $regencies = Regency::where('province_id',$request->province)->get();
        return ResponseHelper::responseJson("Success",200,"List Regencies",$regencies);
    }
}
