<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class AgendaController extends Controller
{
    public function getAllAgenda(){
        $data = [];
        $agenda = Agenda::where('user_id',Auth::user()->id)->get();
        foreach($agenda as $value){
            $contact = !empty($value->Contact) ? $value->Contact->name : null;
            $data[] = [
                'id' => $value->id,
                'contact' => $contact,
                'status' =>$value->status,
                'title' => $value->title,
                'date' => $value->date,
                'time' => $value->time,
                'location' => $value->location
            ];
        }
        return ResponseHelper::responseJson("Success",200,"List Agenda",$data);
    }

    public function getAgenda($id){
        $agenda = Agenda::findOrFail($id);
        $contact = !empty($agenda->Contact) ? $agenda->Contact->name : null;
        $data['id'] = $agenda->id;
        $data['contact'] = $contact;
        $data['status'] = $agenda->status;
        $data['title'] = $agenda->title;
        $data['date'] = $agenda->date;
        $data['time'] = $agenda->time;
        $data['location'] = $agenda->location;
        return ResponseHelper::responseJson("Success",200,"Detail Agenda",$data);
    }

    public function getAgendaByContact($id){
        $data = [];
        $agenda = Agenda::where('user_id',Auth::user()->id)
                        ->where('contact_id',$id)->get();
        foreach($agenda as $value){
            $data[] = [
                'id' => $value->id,
                'contact' =>$value->Contact->name,
                'status' =>$value->status,
                'title' => $value->title,
                'date' => $value->date,
                'time' => $value->time,
                'location' => $value->location
            ];
        }
        return ResponseHelper::responseJson("Success",200,"List Agenda",$data);
    }

    public function getUpcomingAgenda(){
        $date = Carbon::now()->toDateString();
        $time = Carbon::now()->toTimeString();
        $datetime_now = Carbon::parse($date)->setTimeFromTimeString($time);

        $agenda = Agenda::where('user_id',Auth::user()->id)
                ->whereDate('date','>=', $date)
                ->orderBy('date','asc')
                ->orderBy('time','asc')
                ->get();

        $data = [];
        foreach($agenda as $value){
            $datetime_db = Carbon::parse($value->date)->setTimeFromTimeString($value->time);
            $contact = !empty($reminder->Contact) ? $reminder->Contact->name : null;
            if($datetime_now < $datetime_db){
                $data[] = [
                    'id' => $value->id,
                    'contact' => $contact,
                    'title' => $value->title,
                    'status' => $value->status,
                    'date' => $value->date,
                    'time' => $value->time,
                    'location' => $value->location
                ];
            }
        }
        $limitedData = Collection::make($data)->take(3);
        return ResponseHelper::responseJson("Success",200,"Upcoming Agenda",$limitedData);
    }

    public function createAgenda(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'status' => 'required',
            'title' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,$validator->errors(),null);
        }
        $agenda = new Agenda();
        $agenda->user_id = Auth::user()->id;
        $agenda->contact_id = $request->contact;
        $agenda->title = $request->title;
        $agenda->date = $request->date;
        $agenda->time = $request->time;
        $agenda->location = $request->location;
        $agenda->save();
        return ResponseHelper::responseJson("Success",200,"Successful insert data",$agenda);
    }

    public function updateAgenda(Request $request,$id){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'status' => 'required',
            'title' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,$validator->errors(),null);
        }
        $agenda = Agenda::findOrFail($id);
        $agenda->user_id = Auth::user()->id;
        $agenda->contact_id = $request->contact;
        $agenda->title = $request->title;
        $agenda->date = $request->date;
        $agenda->time = $request->time;
        $agenda->location = $request->location;
        $agenda->save();
        return ResponseHelper::responseJson("Success",200,"Successful update data",$agenda);
    }

    public function destroyAgenda($id){
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();
        return ResponseHelper::responseJson("Success",200,"Successful delete data",$agenda);
    }
}
