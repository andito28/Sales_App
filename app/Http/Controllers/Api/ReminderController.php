<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
