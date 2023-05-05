<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Reminder;
use Illuminate\Console\Command;

class CheckReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check reminder every minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date_now = Carbon::now();
        $reminders = Reminder::whereDate('date',$date_now->toDateString())->get();
        foreach($reminders as $reminder){
            $hour_reminder = date('h',strtotime($reminder->time));
            $minute_reminder = date('i',strtotime($reminder->time));
            if($hour_reminder == $date_now->hour){
                if($date_now->minute >= $minute_reminder  && $date_now->minute <=  ($minute_reminder+1) ){
                    $data = new Contact();
                    $data->user_id = 2;
                    $data->save();
                }
            }
        }
    }
}
