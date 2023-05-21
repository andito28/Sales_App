<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReminderController extends Controller
{
    public function checkReminder(){
        $date_now = Carbon::now();
        $reminders = Reminder::whereDate('date',$date_now->toDateString())->get();
        foreach($reminders as $reminder){
            $hour_reminder = date('h',strtotime($reminder->time));
            $minute_reminder = date('i',strtotime($reminder->time));
            if($hour_reminder == $date_now->hour){
                if($date_now->minute >= $minute_reminder  && $date_now->minute <=  ($minute_reminder+1) ){
                    return response()->json('reminder');
                }
            }
        }
    }

    public function getAllReminder(){
        $data = [];
        $reminder = Reminder::where('user_id',Auth::user()->id)->get();
        foreach($reminder as $value){
            $data[] = [
                'id' => $value->id,
                'contact' =>$value->Contact->name,
                'title' => $value->title,
                'reminder_date' => $value->reminder_date,
                'time' => $value->time,
                'notes' => $value->notes,
                'frequency' => $value->frequency
            ];
        }
        return ResponseHelper::responseJson("Success",200,"List Reminder",$data);
    }

    public function getReminder($id){
        $reminder = Reminder::findOrFail($id);
        $data['id'] = $reminder->id;
        $data['contact'] = $reminder->Contact->name;
        $data['title'] = $reminder->title;
        $data['reminder_date'] = $reminder->reminder_date;
        $data['time'] = $reminder->time;
        $data['notes'] = $reminder->notes;
        $data['frequency'] = $reminder->frequency;
        return ResponseHelper::responseJson("Success",200,"Detail Reminder",$data);
    }

    public function getUpcomingReminder(){
        $date = Carbon::now()->toDateString();
        $time = Carbon::now()->toTimeString();

        $reminder = Reminder::where('user_id',Auth::user()->id)
                ->whereDate('reminder_date','>=', $date)
                ->latest('reminder_date')
                ->first();

        $data = null;
        if($reminder){
            if($time < $reminder->time){
                $data['id'] = $reminder->id;
                $data['contact'] = $reminder->Contact->name;
                $data['title'] = $reminder->title;
                $data['reminder_date'] = $reminder->reminder_date;
                $data['time'] = $reminder->time;
                $data['notes'] = $reminder->notes;
                $data['frequency'] = $reminder->frequency;
            }
        }
        return ResponseHelper::responseJson("Success",200,"Upcoming Reminder",$data);
    }

    public function createReminder(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'title' => 'required',
            'reminder_date' => 'required',
            'time' => 'required',
            'notes' => 'required',
            'frequency' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,$validator->errors(),null);
        }
        $reminder = new Reminder();
        $reminder->user_id = Auth::user()->id;
        $reminder->contact_id = $request->contact;
        $reminder->title = $request->title;
        $reminder->reminder_date = $request->reminder_date;
        $reminder->time = $request->time;
        $reminder->notes = $request->notes;
        $reminder->frequency = $request->frequency;
        $reminder->save();
        return ResponseHelper::responseJson("Success",200,"Successful insert data",$reminder);
    }

    public function updateReminder(Request $request,$id){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'title' => 'required',
            'reminder_date' => 'required',
            'time' => 'required',
            'notes' => 'required',
            'frequency' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,$validator->errors(),null);
        }
        $reminder = Reminder::findOrFail($id);
        $reminder->user_id = Auth::user()->id;
        $reminder->contact_id = $request->contact;
        $reminder->title = $request->title;
        $reminder->reminder_date = $request->reminder_date;
        $reminder->time = $request->time;
        $reminder->notes = $request->notes;
        $reminder->frequency = $request->frequency;
        $reminder->save();
        return ResponseHelper::responseJson("Success",200,"Successful update data",$reminder);
    }

    public function destroyReminder($id){
        $reminder = Reminder::findOrFail($id);
        $reminder->delete();
        return ResponseHelper::responseJson("Success",200,"Successful delete data",$reminder);
    }
}
