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


    public function getAllContact(Request $request){
        $data = [];
        $page = $request->query('page', 1);
        $limit = $request->query('limit', 10);
        $contact = Contact::paginate($limit, ['*'], 'page', $page);
        foreach($contact as $value){

            $phone = [];
            $email = [];
            foreach($value->Phone as $item){
                $phone[] = [
                            'number' => $item->phone_number,
                            'type' => $item->type
                            ];
            }
            foreach($value->Email as $item){
                $email[] = $item->email;
            }

            $photo = $value->photo != null ? url('storage/contact-photo/'.$value->photo) : null ;

            $data[] = [
                'id' => $value->id,
                'data_origin' => $value->DataOrigin->information,
                'name' => $value->name,
                'status' => $value->status,
                'photo' => $photo,
                'phone_number' => $phone,
                'email' => $email,
                'city' => $value->city,
                'address' => $value->address,
                'subdistrict' => $value->subdistrict,
                'village' => $value->village,
                'job' => $value->job,
                'date_of_birth' => $value->date_of_birth,
                'hobby' => $value->hobby,
                'relationship_status' => $value->relationship_status,
                'partner_name' => $value->partner_name,
                'partner_job' => $value->partner_job,
                'number_of_children' => $value->number_of_children,
                'contact_record' => $value->contact_record,
                'supporting_notes' => $value->supporting_notes,
                'save_date' => $value->save_date
            ];
        }
        return ResponseHelper::responseJson("Success",200,"Data All Contact",$data);
    }


    public function createContact(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'name' => 'required',
            'data_origin' => 'required',
            'save_date' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }

        $data = [];
        DB::transaction(function() use($request,&$data){
            $contact = new Contact();
            $contact->user_id = Auth::user()->id;
            $contact->data_origin_id = $request->data_origin;
            $contact->status = $request->status;
            $contact->name = $request->name;
            $contact->save_date = $request->save_date;
            $contact->save();

            foreach($request->phone as $key => $value){
                $phone = new Phone();
                $phone->contact_id = $contact->id;
                $phone->phone_number = $value;
                $phone->type = $request['type'][$key];
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

    public function updateContact(Request $request,$id){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'name' => 'required',
            'data_origin' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,$validator->errors(),null);
        }

        $data = [];
        DB::transaction(function() use($request,&$data,&$id){
            $contact = Contact::findOrFail($id);
            foreach($contact->Phone as $key => $value){
                $phone = Phone::findOrFail($value->id);
                $phone->phone_number = $request->phone[$key];
                $phone->type = $request->type[$key];
                $phone->save();
            }
            $data[] = $contact;
            return compact('data');
        });
        return ResponseHelper::responseJson("Success",200,"Successful update data",$data);
    }

    public function getStatusContact(){
        $data = [];
        $contact = Contact::select('status', \DB::raw('count(*) as total'))
        ->groupBy('status')
        ->where('user_id',Auth::user()->id)
        ->get();
        foreach($contact as $value){
            $data[] = [
                'status' => $value->status,
                'total' => $value->total
            ];
        }
        return ResponseHelper::responseJson("Success",200,"Data Status Contact",$contact);
    }

    public function getInformationContact(){
        $data['total_contact'] = Contact::where('user_id',Auth::user()->id)->count();
        $data['hot'] = Contact::where('user_id',Auth::user()->id)->where('status','hot')->count();
        $data['medium'] = Contact::where('user_id',Auth::user()->id)->where('status','medium')->count();
        $data['low'] = Contact::where('user_id',Auth::user()->id)->where('status','low')->count();
        $data['follow_up'] = Contact::where('user_id',Auth::user()->id)->where('status','follow_up')->count();
        $data['next_follow_up'] = Contact::where('user_id',Auth::user()->id)->where('status','next_follow_up')->count();
        $data['customer'] = Contact::where('user_id',Auth::user()->id)->where('status','customer')->count();
        return ResponseHelper::responseJson("Success",200,"Contact information",$data);
    }

    public function searchContact(Request $request){
        $contact = Contact::where('name','like',"%".$request->name."%")->get();
        $data = [];
        foreach($contact as $value){
            $phones = [];
            foreach($value->Phone as $phone){
                $phones[] = [
                    'number' => $phone->phone_number,
                    'type' => $phone->type
                ];
            }
            $emails = [];
            foreach($value->Email as $email){
                $emails[] = $email->email;
            }
            $data[] = [
                'data_origin' => $value->DataOrigin->information,
                'name' => $value->name,
                'status' => $value->status,
                'phone_number' => $phones,
                'email' => $emails
            ];
        }
        return ResponseHelper::responseJson("Success",200,"Successful Search Contact",$data);
    }
}
