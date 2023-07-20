<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Reminder;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReminderController extends Controller
{
    public function checkReminder(){
        $date_now = Carbon::now();
        $reminders = Reminder::whereDate('reminder_date',$date_now->toDateString())->get();
        foreach($reminders as $reminder){
            $hour_reminder = date('h',strtotime($reminder->time));
            $minute_reminder = date('i',strtotime($reminder->time));
            if($hour_reminder == $date_now->hour){
                if($date_now->minute >= $minute_reminder  && $date_now->minute < ($minute_reminder+1) ){
                    Notification::create([
                        'user_id' => $reminder->user_id,
                        'notification' => $reminder->title
                    ]);
                    return response()->json([
                        'message' => 'Success create notification'
                    ]);
                }
            }
        }
    }

    public function getAllReminder(){
        $data = [];
        $reminder = Reminder::where('user_id',Auth::user()->id)->get();
        foreach($reminder as $value){
            $contact = !empty($value->Contact) ? $value->Contact->name : null;
            $contact_id = !empty($value->Contact->id) ? $value->Contact->id : null;
            $data[] = [
                'id' => $value->id,
                'contact' =>$contact,
                'contact_id' =>$contact_id,
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
        $contact = !empty($reminder->Contact) ? $reminder->Contact->name : null;
        $data['id'] = $reminder->id;
        $data['contact'] = $contact;
        $data['title'] = $reminder->title;
        $data['reminder_date'] = $reminder->reminder_date;
        $data['time'] = $reminder->time;
        $data['notes'] = $reminder->notes;
        $data['frequency'] = $reminder->frequency;
        return ResponseHelper::responseJson("Success",200,"Detail Reminder",$data);
    }

    public function getReminderByContact($id){
        $date = Carbon::now()->toDateString();
        $time = Carbon::now()->toTimeString();
        $datetime_now = Carbon::parse($date)->setTimeFromTimeString($time);

        $reminder = Reminder::where('user_id',Auth::user()->id)
                ->whereDate('reminder_date','>=', $date)
                ->orderBy('reminder_date','asc')
                ->orderBy('time','asc')
                ->where('contact_id',$id)
                ->get();

        $data = [];
        foreach($reminder as $value){
            $datetime_db = Carbon::parse($value->reminder_date)->setTimeFromTimeString($value->time);
            $contact = !empty($value->Contact) ? $value->Contact->name : null;
            if($datetime_now < $datetime_db){
                $data[] = [
                    'id' => $value->id,
                    'contact' => $contact,
                    'title' => $value->title,
                    'reminder_date' => $value->reminder_date,
                    'time' => $value->time,
                    'notes' => $value->notes,
                    'frequency' => $value->frequency
                ];
            }
        }
        return ResponseHelper::responseJson("Success",200,"List Reminder",$data);
    }

    public function getUpcomingReminder(){
        $date = Carbon::now()->toDateString();
        $time = Carbon::now()->toTimeString();
        $datetime_now = Carbon::parse($date)->setTimeFromTimeString($time);

        $reminder = Reminder::where('user_id',Auth::user()->id)
                ->whereDate('reminder_date','>=', $date)
                ->orderBy('reminder_date','asc')
                ->orderBy('time','asc')
                ->get();

        $data = [];
        foreach($reminder as $value){
            $datetime_db = Carbon::parse($value->reminder_date)->setTimeFromTimeString($value->time);
            $contact = !empty($value->Contact) ? $value->Contact->name : null;
            if($datetime_now < $datetime_db){
                $data[] = [
                    'id' => $value->id,
                    'contact' => $contact,
                    'title' => $value->title,
                    'reminder_date' => $value->reminder_date,
                    'time' => $value->time,
                    'notes' => $value->notes,
                    'frequency' => $value->frequency
                ];
            }
        }
        $limitedData = Collection::make($data)->take(3);
        return ResponseHelper::responseJson("Success",200,"Upcoming Reminder",$limitedData);
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
