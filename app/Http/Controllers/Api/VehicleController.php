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
use Illuminate\Support\Facades\Storage;
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
            'ownership' => 'required',
            'dp' => 'required',
            'notes' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }

        $files = $request->file('deals_photo');
        if ($files) {
            $file_name = date('YmdHis').str_replace('', '', $files->getClientOriginalName());
            Storage::disk('local')->putFileAs('public/deals-photo', $files, $file_name);
        }else{
            $file_name = null;
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
        $dream_vehicle->purchase_date = $request->purchase_date;
        $dream_vehicle->leasing = $request->leasing;
        $dream_vehicle->dp = $request->dp;
        $dream_vehicle->repayment = $request->repayment;
        $dream_vehicle->installment = $request->installment;
        $dream_vehicle->number_of_month = $request->number_of_month;
        $dream_vehicle->ownership = $request->ownership;
        $dream_vehicle->notes = $request->notes;
        $dream_vehicle->deals_photo = $file_name;
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

        $files = $request->file('deals_photo');
        if ($files) {
            if($dream_vehicle->deals_photo != null){
                Storage::delete('/public/deals-photo/'. $dream_vehicle->deals_photo);
            }
            $file_name = date('YmdHis').str_replace('', '', $files->getClientOriginalName());
            Storage::disk('local')->putFileAs('public/deals-photo', $files, $file_name);
        }else{
            $file_name = $dream_vehicle->deals_photo;
        }

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
        $dream_vehicle->purchase_date = $request->purchase_date;
        $dream_vehicle->leasing = $request->leasing;
        $dream_vehicle->dp = $request->dp;
        $dream_vehicle->repayment = $request->repayment;
        $dream_vehicle->installment = $request->installment;
        $dream_vehicle->number_of_month = $request->number_of_month;
        $dream_vehicle->ownership = $request->ownership;
        $dream_vehicle->notes = $request->notes;
        $dream_vehicle->deals_photo = $file_name;
        $dream_vehicle->sold_status = $request->sold_status;
        $dream_vehicle->save();
        return ResponseHelper::responseJson("Success",200,"Successful update data",$dream_vehicle);
    }

    public function detailDreamVehicle($id){
        $dream_vehicle = DreamVehicle::findOrFail($id);
        $deals_photo = $dream_vehicle->deals_photo != null ? url('storage/deals-photo/'.$dream_vehicle->deals_photo) : null ;
        $vehicle_name = [
            'id' => $dream_vehicle->VehicleName->id,
            'vehicle_name' => $dream_vehicle->VehicleName->name
        ];
        $vehicle_brand = [
            'id' => $dream_vehicle->VehicleBrand->id,
            'vehicle_brand' => $dream_vehicle->VehicleBrand->brand
        ];
        $vehicle_color = [
            'id' => $dream_vehicle->VehicleColor->id,
            'vehicle_color' => $dream_vehicle->VehicleColor->color
        ];
        $vehicle_type = [
            'id' => $dream_vehicle->VehicleType->id,
            'vehicle_type' => $dream_vehicle->VehicleType->type
        ];
        $data['id'] = $dream_vehicle->id;
        $data['contact']= $dream_vehicle->Contact->name;
        $data['contact_id']= $dream_vehicle->Contact->id;
        $data['status'] = $dream_vehicle->status;
        $data['item_condition'] = $dream_vehicle->item_condition;
        $data['vehicle_brand']= $vehicle_brand;
        $data['vehicle_name'] = $vehicle_name;
        $data['vehicle_type'] = $vehicle_type;
        $data['vehicle_color'] = $vehicle_color;
        $data['transmission'] = $dream_vehicle->transmission;
        $data['payment'] = $dream_vehicle->payment;
        $data['purchase_date'] = $dream_vehicle->purchase_date;
        $data['leasing'] = $dream_vehicle->leasing;
        $data['dp']= $dream_vehicle->dp;
        $data['repayment'] = $dream_vehicle->repayment;
        $data['installment'] = $dream_vehicle->installment;
        $data['number_of_month'] = $dream_vehicle->number_of_month;
        $data['ownership'] = $dream_vehicle->ownership;
        $data['notes'] = $dream_vehicle->notes;
        $data['deals_photo'] = $deals_photo;
        $data['sold_status'] = $dream_vehicle->sold_status;
        return ResponseHelper::responseJson("Success",200,"Detail Dream Vehicle",$data);
    }

    public function getDreamVehicleByContact($id){
        $data = [];
        $dream_vehicle = DreamVehicle::where('contact_id',$id)->get();

        foreach($dream_vehicle as $value){
            $deals_photo = $value->deals_photo != null ? url('storage/deals-photo/'.$value->deals_photo) : null ;
            $vehicle_name = [
                'id' => $value->VehicleName->id,
                'vehicle_name' => $value->VehicleName->name
            ];
            $vehicle_brand = [
                'id' => $value->VehicleBrand->id,
                'vehicle_brand' => $value->VehicleBrand->brand
            ];
            $vehicle_color = [
                'id' => $value->VehicleColor->id,
                'vehicle_color' => $value->VehicleColor->color
            ];
            $vehicle_type = [
                'id' => $value->VehicleType->id,
                'vehicle_type' => $value->VehicleType->type
            ];
            $data[] = [
                'id' => $value->id,
                'contact' => $value->Contact->name,
                'contact_id' => $value->Contact->id,
                'status' => $value->status,
                'item_condition' => $value->item_condition,
                'vehicle_brand' => $vehicle_brand,
                'vehicle_name' => $vehicle_name,
                'vehicle_type' => $vehicle_type,
                'vehicle_color' => $vehicle_color,
                'transmission' => $value->transmission,
                'payment' => $value->payment,
                'purchase_date' => $value->purchase_date,
                'leasing' => $value->leasing,
                'dp'=> $value->dp,
                'repayment' => $value->repayment,
                'installment' => $value->installment,
                'number_of_month' => $value->number_of_month,
                'ownership' => $value->ownership,
                'notes' => $value->notes,
                'deals_photo' => $deals_photo,
                'sold_status' => $value->sold_status,
            ];
        }
        return ResponseHelper::responseJson("Success",200,"List Dream Vehicle",$data);
    }

    public function GetDealsPhoto(Request $request){
        $id = $request->contact;
        $datas = DreamVehicle::select('id','deals_photo')->where('contact_id',$id)->get();
        $data = [];
        foreach($datas as $value){
            if($value->deals_photo != null){
                $data[] = [
                    'id' => $value->id,
                    'deals_photo' => url('storage/deals-photo/'.$value->deals_photo)
                ];
            }
        }
        return ResponseHelper::responseJson("Success",200,"List Deals Photo",$data);
    }
}
