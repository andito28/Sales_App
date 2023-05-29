<?php

namespace App\Http\Controllers\Api;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotification(){
        $notification = Notification::where('user_id',Auth::user()->id)->get();
        $data = [];
        foreach($notification as $value){
            $data[] = [
                'id' => $value->id,
                'notification' => $value->notification,
                'read' => $value->read
            ];
        }
        return ResponseHelper::responseJson("Success",200,"List Notification",$data);
    }

    public function updateNotification($id){
        $data = Notification::findOrFail($id);
        $data->read = "true";
        $data->save();
        return ResponseHelper::responseJson("Success",200,"Successful Update Data",$data);
    }

    public function destroyNotification($id){
        $data = Notification::findOrFail($id);
        $data->delete();
        return ResponseHelper::responseJson("Success",200,"Successful Delete Data",$data);
    }
}
