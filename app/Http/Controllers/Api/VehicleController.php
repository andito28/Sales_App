<?php

namespace App\Http\Controllers\Api;

use App\Models\VehicleName;
use App\Models\VehicleType;
use App\Models\VehicleBrand;
use App\Models\VehicleColor;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    public function getVehicleName(){
        $data = [];
        $vehicle = VehicleName::all();
        foreach($vehicle as $value){
            $data[] = [
                'id' => $value->id,
                'vehicle_name'=>$value->name
            ];
        }
        return ResponseHelper::responseJson("Success",200,"Vehicle Name Data",$data);
    }

    public function getVehicleBrand(){
        $data = [];
        $vehicle = VehicleBrand::all();
        foreach($vehicle as $value){
            $data[] = [
                'id' => $value->id,
                'vehicle_brand'=>$value->brand
            ];
        }
        return ResponseHelper::responseJson("Success",200,"Vehicle Brand Data",$data);
    }

    public function getVehicleType(){
        $data = [];
        $vehicle = VehicleType::all();
        foreach($vehicle as $value){
            $data[] = [
                'id' => $value->id,
                'vehicle_type'=>$value->type
            ];
        }
        return ResponseHelper::responseJson("Success",200,"Vehicle Type Data",$data);
    }

    public function getVehicleColor(){
        $data = [];
        $vehicle = VehicleColor::all();
        foreach($vehicle as $value){
            $data[] = [
                'id' => $value->id,
                'vehicle_color'=>$value->color
            ];
        }
        return ResponseHelper::responseJson("Success",200,"Vehicle Color Data",$data);
    }


}
