<?php

namespace App\Http\Controllers\Api;

use App\Models\Email;
use App\Models\Phone;
use App\Models\Contact;
use App\Models\DataOrigin;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function getDataOrigin(){
        $data = [];
        $data_origin = DataOrigin::all();
        foreach($data_origin as $value){
            $data[] = [
                'id' => $value->id,
                'information' => $value->information
            ];
        }
        return ResponseHelper::responseJson("Success",200,"Data Origin",$data);
    }


    public function getAllContact(){
        $data = [];
        $contact = Contact::all();
        foreach($contact as $value){
            $data[] = [
                'data_origin' => $value->DataOrigin->information,
                'name' => $value->name,
                'status' => $value->status,
                'photo' => url('storage/contact-photo/'.$value->photo),
                'city' => $value->city,
                'address' => $value->address,
                'subdistrict' => $value->subdistrict,
                'village' => $value->village,
                'company' => $value->company,
                'date_of_birth' => $value->date_of_birth,
                'hobby' => $value->hobby,
                'relationship_status' => $value->relationship_status,
                'partner_name' => $value->partner_name,
                'partner_company' => $value->partner_company,
                'number_of_children' => $value->number_of_children,
                'contact_record' => $value->contact_record,
                'supporting_notes' => $value->supporting_notes
            ];
        }
        return ResponseHelper::responseJson("Success",200,"Data All Contact",$data);
    }


    public function createContact(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'name' => 'required',
            'data_origin' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }

        $data = [];
        DB::transaction(function() use($request,&$data){
            $contact = new Contact();
            $contact->user_id = Auth::user()->id;
            $contact->data_origin_id = $request->data_origin;
            $contact->name = $request->name;
            $contact->save();

            foreach($request->phone as $value){
                $phone = new Phone();
                $phone->contact_id = $contact->id;
                $phone->phone_number = $value;
                $phone->type = "phone";
                $phone->save();
            }

            foreach($request->email as $value){
                $email = new Email();
                $email->contact_id = $contact->id;
                $email->email = $value;
                $email->save();
            }

            $data [] = [
                'name' => $contact->name,
                'data_origin' => $contact->DataOrigin->information,
                'phone_number' => $request->phone,
                'email' => $request->email,
            ];
            return compact('data');
        });
        return ResponseHelper::responseJson("Success",200,"Successful insert data",$data);
    }
}
