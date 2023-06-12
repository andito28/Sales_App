<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\SubmissionPhoto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubmissionPhotoController extends Controller
{
    public function createSubmissionPhoto(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'contact' => 'required',
            'photo' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }
        $files = $request->hasFile('photo');
        if ($files) {
            $images = $request->file('photo');
            foreach ($images as $image) {
                $file_name = date('YmdHis').str_replace('', '', $image->getClientOriginalName());
                Storage::disk('local')->putFileAs('public/photo', $image, $file_name);
                $data = new SubmissionPhoto();
                $data->contact_id = $request->contact;
                $data->photo = $file_name;
                $data->save();
            }
        }
        return ResponseHelper::responseJson("Success",200,"Successful insert data",$data);
    }

    public function destroySubmissionPhoto($id){
        $data = SubmissionPhoto::findOrFail($id);
        Storage::delete('/public/photo/'. $data->photo);
        $data->delete();
        return ResponseHelper::responseJson("Success",200,"Successful delete data",$data);
    }

    public function getSubmissionPhotoByContact($id){
        $data = [];
        $submission_photo = SubmissionPhoto::where('contact_id',$id)->get();
        foreach($submission_photo as $value){
            $data[] = [
                'id' => $value->id,
                'contact' => $value->Contact->name,
                'photo' => url('storage/photo/'.$value->photo)
            ];
        }
        return ResponseHelper::responseJson("Success",200,"List Submission Photo",$data);
    }
}
