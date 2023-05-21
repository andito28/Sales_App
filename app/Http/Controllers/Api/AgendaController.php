<?php

namespace App\Http\Controllers\Api;

use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{
    public function getAllAgenda(){
        $data = [];
        $agenda = Agenda::where('user_id',Auth::user()->id)->get();
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

    public function getAgenda($id){
        $agenda = Agenda::findOrFail($id);
        $data['id'] = $agenda->id;
        $data['contact'] = $agenda->Contact->name;
        $data['status'] = $agenda->status;
        $data['title'] = $agenda->title;
        $data['date'] = $agenda->date;
        $data['time'] = $agenda->time;
        $data['location'] = $agenda->location;
        return ResponseHelper::responseJson("Success",200,"Detail Agenda",$data);
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
