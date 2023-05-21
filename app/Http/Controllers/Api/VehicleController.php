<?php

namespace App\Http\Controllers\Api;

use App\Models\VehicleName;
use App\Models\VehicleType;
use App\Models\VehicleBrand;
use App\Models\VehicleColor;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    //CRUD Vehicle name
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

    public function createVehicleName(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'vehicle_name' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }
        $vehicle = new VehicleName();
        $vehicle->user_id = Auth::user()->id;
        $vehicle->name = $request->vehicle_name;
        $vehicle->save();
        return ResponseHelper::responseJson("Success",200,"Successful insert data",$vehicle);
    }

    public function updateVehicleName(Request $request,$id){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'vehicle_name' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }
        $vehicle = VehicleName::findOrFail($id);
        $vehicle->name = $request->vehicle_name;
        $vehicle->save();
        return ResponseHelper::responseJson("Success",200,"Successful update data",$vehicle);
    }

    public function deleteVehicleName($id){
        $vehicle = VehicleName::findOrFail($id);
        $vehicle->delete();
        return ResponseHelper::responseJson("Success",200,"Successful delete data",$vehicle);
    }

    //CRUD Vehicle Brand
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

    public function createVehicleBrand(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'vehicle_brand' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }
        $vehicle = new VehicleBrand();
        $vehicle->user_id = Auth::user()->id;
        $vehicle->brand = $request->vehicle_brand;
        $vehicle->save();
        return ResponseHelper::responseJson("Success",200,"Successful insert data",$vehicle);
    }

    public function updateVehicleBrand(Request $request,$id){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'vehicle_brand' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }
        $vehicle = VehicleBrand::findOrFail($id);
        $vehicle->brand = $request->vehicle_brand;
        $vehicle->save();
        return ResponseHelper::responseJson("Success",200,"Successful update data",$vehicle);
    }

    public function deleteVehicleBrand($id){
        $vehicle = VehicleBrand::findOrFail($id);
        $vehicle->delete();
        return ResponseHelper::responseJson("Success",200,"Successful delete data",$vehicle);
    }

    //CRUD Vehicle Type
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

    public function createVehicleType(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'vehicle_type' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }
        $vehicle = new VehicleType();
        $vehicle->user_id = Auth::user()->id;
        $vehicle->type = $request->vehicle_type;
        $vehicle->save();
        return ResponseHelper::responseJson("Success",200,"Successful insert data",$vehicle);
    }

    public function updateVehicleType(Request $request,$id){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'vehicle_type' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }
        $vehicle = VehicleType::findOrFail($id);
        $vehicle->type = $request->vehicle_type;
        $vehicle->save();
        return ResponseHelper::responseJson("Success",200,"Successful update data",$vehicle);
    }

    public function deleteVehicleType($id){
        $vehicle = VehicleType::findOrFail($id);
        $vehicle->delete();
        return ResponseHelper::responseJson("Success",200,"Successful delete data",$vehicle);
    }

     //CRUD Vehicle Color
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

    public function createVehicleColor(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'vehicle_color' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }
        $vehicle = new VehicleColor();
        $vehicle->user_id = Auth::user()->id;
        $vehicle->color = $request->vehicle_color;
        $vehicle->save();
        return ResponseHelper::responseJson("Success",200,"Successful insert data",$vehicle);
    }

    public function updateVehicleColor(Request $request,$id){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'vehicle_color' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }
        $vehicle = VehicleColor::findOrFail($id);
        $vehicle->color = $request->vehicle_color;
        $vehicle->save();
        return ResponseHelper::responseJson("Success",200,"Successful update data",$vehicle);
    }

    public function deleteVehicleColor($id){
        $vehicle = VehicleColor::findOrFail($id);
        $vehicle->delete();
        return ResponseHelper::responseJson("Success",200,"Successful delete data",$vehicle);
    }


}
