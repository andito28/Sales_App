<?php

namespace App\Http\Controllers\Api;

use App\Models\VehicleName;
use App\Models\VehicleType;
use App\Models\DreamVehicle;
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


    //CRUD Dream Vehicle
    public function createDreamVehicle(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'contact' => 'required',
            'item_condition' => 'required',
            'vehicle_name' => 'required',
            'vehicle_brand' => 'required',
            'vehicle_type' => 'required',
            'vehicle_color' => 'required',
            'dp' => 'required',
            'notes' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }

        $dream_vehicle = new DreamVehicle();
        $dream_vehicle->status = $request->status;
        $dream_vehicle->contact_id = $request->contact;
        $dream_vehicle->item_condition = $request->item_condition;
        $dream_vehicle->vehicle_brand_id = $request->vehicle_brand;
        $dream_vehicle->vehicle_name_id = $request->vehicle_name;
        $dream_vehicle->vehicle_type_id = $request->vehicle_type;
        $dream_vehicle->vehicle_color_id = $request->vehicle_color;
        $dream_vehicle->transmission = $request->transmission;
        $dream_vehicle->payment = $request->payment;
        $dream_vehicle->leasing = $request->leasing;
        $dream_vehicle->dp = $request->dp;
        $dream_vehicle->repayment = $request->repayment;
        $dream_vehicle->installment = $request->installment;
        $dream_vehicle->number_of_month = $request->number_of_month;
        $dream_vehicle->ownership = $request->ownership;
        $dream_vehicle->notes = $request->notes;
        $dream_vehicle->sold_status = $request->sold_status;
        $dream_vehicle->save();
        return ResponseHelper::responseJson("Success",200,"Successful insert data",$dream_vehicle);
    }

    public function updateDreamVehicle(Request $request,$id){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'contact' => 'required',
            'item_condition' => 'required',
            'vehicle_name' => 'required',
            'vehicle_brand' => 'required',
            'vehicle_type' => 'required',
            'vehicle_color' => 'required',
            'ownership' => 'required',
            'dp' => 'required',
            'notes' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }

        $dream_vehicle = DreamVehicle::findOrFail($id);
        $dream_vehicle->id = $request->id;
        $dream_vehicle->status = $request->status;
        $dream_vehicle->contact_id = $request->contact;
        $dream_vehicle->item_condition = $request->item_condition;
        $dream_vehicle->vehicle_brand_id = $request->vehicle_brand;
        $dream_vehicle->vehicle_name_id = $request->vehicle_name;
        $dream_vehicle->vehicle_type_id = $request->vehicle_type;
        $dream_vehicle->vehicle_color_id = $request->vehicle_color;
        $dream_vehicle->transmission = $request->transmission;
        $dream_vehicle->payment = $request->payment;
        $dream_vehicle->leasing = $request->leasing;
        $dream_vehicle->dp = $request->dp;
        $dream_vehicle->repayment = $request->repayment;
        $dream_vehicle->installment = $request->installment;
        $dream_vehicle->number_of_month = $request->number_of_month;
        $dream_vehicle->ownership = $request->ownership;
        $dream_vehicle->notes = $request->notes;
        $dream_vehicle->sold_status = $request->sold_status;
        $dream_vehicle->save();
        return ResponseHelper::responseJson("Success",200,"Successful update data",$dream_vehicle);
    }

    public function detailDreamVehicle($id){
        $dream_vehicle = DreamVehicle::findOrFail($id);
        $vehicle_name = [
            'id' => $dream_vehicle->VehicleName->id,
            'name' => $dream_vehicle->VehicleName->name
        ];
        $vehicle_brand = [
            'id' => $dream_vehicle->VehicleBrand->id,
            'brand' => $dream_vehicle->VehicleBrand->brand
        ];
        $vehicle_color = [
            'id' => $dream_vehicle->VehicleColor->id,
            'color' => $dream_vehicle->VehicleColor->color
        ];
        $vehicle_type = [
            'id' => $dream_vehicle->VehicleType->id,
            'type' => $dream_vehicle->VehicleType->type
        ];
        $data['id'] = $dream_vehicle->id;
        $data['contact']= $dream_vehicle->Contact->name;
        $data['status'] = $dream_vehicle->status;
        $data['item_condition'] = $dream_vehicle->item_condition;
        $data['vehicle_brand']= $vehicle_brand;
        $data['vehicle_name'] = $vehicle_name;
        $data['vehicle_type'] = $vehicle_type;
        $data['vehicle_color'] = $vehicle_color;
        $data['transmission'] = $dream_vehicle->transmission;
        $data['payment'] = $dream_vehicle->payment;
        $data['leasing'] = $dream_vehicle->leasing;
        $data['dp']= $dream_vehicle->dp;
        $data['repayment'] = $dream_vehicle->repayment;
        $data['installment'] = $dream_vehicle->installment;
        $data['number_of_month'] = $dream_vehicle->number_of_month;
        $data['ownership'] = $dream_vehicle->ownership;
        $data['notes'] = $dream_vehicle->notes;
        $data['sold_status'] = $dream_vehicle->sold_status;
        return ResponseHelper::responseJson("Success",200,"Detail Dream Vehicle",$data);
    }

    public function getDreamVehicleByContact($id){
        $data = [];
        $dream_vehicle = DreamVehicle::where('contact_id',$id)->get();

        foreach($dream_vehicle as $value){
            $vehicle_name = [
                'id' => $value->VehicleName->id,
                'name' => $value->VehicleName->name
            ];
            $vehicle_brand = [
                'id' => $value->VehicleBrand->id,
                'brand' => $value->VehicleBrand->brand
            ];
            $vehicle_color = [
                'id' => $value->VehicleColor->id,
                'color' => $value->VehicleColor->color
            ];
            $vehicle_type = [
                'id' => $value->VehicleType->id,
                'type' => $value->VehicleType->type
            ];
            $data[] = [
                'id' => $value->id,
                'contact' => $value->Contact->name,
                'status' => $value->status,
                'item_condition' => $value->item_condition,
                'vehicle_brand' => $vehicle_brand,
                'vehicle_name' => $vehicle_name,
                'vehicle_type' => $vehicle_type,
                'vehicle_color' => $vehicle_color,
                'transmission' => $value->transmission,
                'payment' => $value->payment,
                'leasing' => $value->leasing,
                'dp'=> $value->dp,
                'repayment' => $value->repayment,
                'installment' => $value->installment,
                'number_of_month' => $value->number_of_month,
                'ownership' => $value->ownership,
                'notes' => $value->notes,
                'sold_status' => $value->sold_status,
            ];
        }
        return ResponseHelper::responseJson("Success",200,"List Dream Vehicle",$data);
    }
}
