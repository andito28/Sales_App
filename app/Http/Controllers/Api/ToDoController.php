<?php

namespace App\Http\Controllers\Api;

use App\Models\ToDo;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ToDoController extends Controller
{
    public function getAllByUser(){
        $data = [];
        $todo = ToDo::where('user_id',Auth::user()->id)->get();
        foreach($todo as $value){
            $data[] = [
                'id' => $value->id,
                'notes' =>$value->notes,
                'selected' =>$value->selected
            ];
        }
        return ResponseHelper::responseJson("Success",200,"List To Do",$data);
    }

    public function createToDo(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'notes' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }
        $todo = new ToDo();
        $todo->user_id = Auth::user()->id;
        $todo->notes = $request->notes;
        $todo->save();
        return ResponseHelper::responseJson("Success",200,"Successful insert data",$todo);
    }

    public function updateToDo(Request $request,$id){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'notes' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }
        $todo = ToDo::findOrFail($id);
        $todo->notes = $request->notes;
        $todo->selected = $request->selected;
        $todo->save();
        return ResponseHelper::responseJson("Success",200,"Successful update data",$todo);
    }
}
