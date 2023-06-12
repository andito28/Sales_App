<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Email;
use App\Models\Phone;
use App\Models\Contact;
use App\Models\DataOrigin;
use App\Models\VehicleName;
use App\Models\VehicleType;
use App\Models\DreamVehicle;
use App\Models\VehicleBrand;
use App\Models\VehicleColor;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        if( $request->filter == "true"){
            $query = Contact::query()->where('user_id',Auth::user()->id);
            if ($request->has('city') && $request->city != null) {
                $query->where('city',$request->city);
            }
            if ($request->has('status_contact') && $request->status_contact != null) {
                $query->where('status',$request->status_contact);
            }
            if ($request->has('gender') && $request->gender != null) {
                $query->where('gender',$request->gender);
            }
            if ($request->has('data_origin') && $request->data_origin != null) {
                $query->where('data_origin_id',$request->data_origin);
            }
            if ($request->has('age')&& $request->age != null) {
                $age = $request->age;
                $date_now = Carbon::now();
                $date_of_birth = $date_now->subYears($age)->toDateString();
                $carbonDate = Carbon::parse($date_of_birth);
                $month = $carbonDate->month;
                $query->whereYear('date_of_birth',$date_of_birth)
                    ->whereMonth('date_of_birth','<=',$month);
            }
            if ($request->has('purchase_date_range') && $request->purchase_date_range != null) {
                $date_range = explode(',',$request->purchase_date_range);
                $startDate = Carbon::parse($date_range[0]);
                $endDate = Carbon::parse($date_range[1]);
                $query->whereHas('DreamVehicle', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('purchase_date', [$startDate, $endDate]);
                })->get();
            }
            if ($request->has('transmission') && $request->transmission != null) {
                $transmission = $request->transmission;
                $query->whereHas('DreamVehicle', function ($q) use ($transmission) {
                    $q->where('transmission',$transmission);
                })->get();
            }
            if ($request->has('type_car_sold') && $request->type_car_sold != null) {
                $car_type = $request->type_car_sold;
                $query->whereHas('DreamVehicle', function ($q) use ($car_type) {
                    $q->where('vehicle_type_id',$car_type)->where('sold_status','true');
                })->get();
            }
            if ($request->has('color_car_sold') && $request->color_car_sold != null) {
                $car_color = $request->color_car_sold;
                $query->whereHas('DreamVehicle', function ($q) use ($car_color) {
                    $q->where('vehicle_color_id',$car_color)->where('sold_status','true');
                })->get();
            }
            if ($request->has('brand_car_sold') && $request->brand_car_sold != null) {
                $car_brand = $request->brand_car_sold;
                $query->whereHas('DreamVehicle', function ($q) use ($car_brand) {
                    $q->where('vehicle_brand_id',$car_brand)->where('sold_status','true');
                })->get();
            }
            if ($request->has('payment') && $request->payment != null) {
                $payment = $request->payment;
                $query->whereHas('DreamVehicle', function ($q) use ($payment) {
                    $q->where('payment',$payment);
                })->get();
            }
            if ($request->has('ownership') && $request->ownership != null) {
                $ownership = $request->ownership;
                $query->whereHas('DreamVehicle', function ($q) use ($ownership) {
                    $q->where('ownership',$ownership);
                })->get();
            }
            if ($request->has('vehicle_name') && $request->vehicle_name != null) {
                $vehicle_name = $request->vehicle_name;
                $query->whereHas('DreamVehicle', function ($q) use ($vehicle_name) {
                    $q->where('vehicle_name_id',$vehicle_name);
                })->get();
            }
            $contact =  $query->paginate($limit, ['*'], 'page', $page);
        }else{
            $contact = Contact::where('user_id',Auth::user()->id)->paginate($limit, ['*'], 'page', $page);
        }
        foreach($contact as $value){
            $phone = [];
            $email = [];
            foreach($value->Phone as $item){
                $phone[] = [
                            'id' => $item->id,
                            'number' => $item->phone_number,
                            'type' => $item->type
                            ];
            }
            foreach($value->Email as $item){
                $email[] = [
                    'id' => $item->id,
                    'email' => $item->email
                ];
            }
            $photo = $value->photo != null ? url('storage/contact-photo/'.$value->photo) : null ;
            $data_origin = $value->data_origin_id != null ? $value->DataOrigin->information : null ;
            $data[] = [
                'id' => $value->id,
                'data_origin' => $data_origin,
                'name' => $value->name,
                'gender' => $value->gender,
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

    public function getDetailContact($id){
        $contact = Contact::findOrFail($id);
        foreach($contact->Phone as $item){
            $phone[] = [
                        'id' => $item->id,
                        'number' => $item->phone_number,
                        'type' => $item->type
                        ];
        }
        foreach($contact->Email as $item){
            $email[] = [
                'id' => $item->id,
                'email' => $item->email
            ];
        }
        $photo = $contact->photo != null ? url('storage/contact-photo/'.$contact->photo) : null ;
        $data_origin = $contact->data_origin_id != null ? $contact->DataOrigin->information : null ;
        $data[] = [
            'id' => $contact->id,
            'data_origin' => $data_origin,
            'name' => $contact->name,
            'gender' => $contact->gender,
            'status' => $contact->status,
            'photo' => $photo,
            'phone_number' => $phone,
            'email' => $email,
            'city' => $contact->city,
            'address' => $contact->address,
            'subdistrict' => $contact->subdistrict,
            'village' => $contact->village,
            'job' => $contact->job,
            'date_of_birth' => $contact->date_of_birth,
            'hobby' => $contact->hobby,
            'relationship_status' => $contact->relationship_status,
            'partner_name' => $contact->partner_name,
            'partner_job' => $contact->partner_job,
            'number_of_children' => $contact->number_of_children,
            'contact_record' => $contact->contact_record,
            'supporting_notes' => $contact->supporting_notes,
            'save_date' => $contact->save_date
        ];
        return ResponseHelper::responseJson("Success",200,"Detail Contact",$data);
    }

    public function createContact(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'name' => 'required',
            'status' => 'required',
            'save_date' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,"Validasi Error",$validator->errors());
        }

        $data = [];
        DB::transaction(function() use($request,&$data){
            $files = $request->file('photo');
            if ($files) {
                $file_name = date('YmdHis').str_replace('', '', $files->getClientOriginalName());
                Storage::disk('local')->putFileAs('public/contact-photo', $files, $file_name);
            }else{
                $file_name = null;
            }
            $contact = new Contact();
            $contact->user_id = Auth::user()->id;
            $contact->status = $request->status;
            $contact->name = $request->name;
            $contact->photo = $file_name;
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
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,$validator->errors(),null);
        }

        $data = [];
        DB::transaction(function() use($request,&$data,&$id){
            $contact = Contact::findOrFail($id);
            $files = $request->file('photo');
            if ($files) {
                if($contact->photo != null){
                    Storage::delete('/public/contact-photo/'. $contact->photo);
                }
                $file_name = date('YmdHis').str_replace('', '', $files->getClientOriginalName());
                Storage::disk('local')->putFileAs('public/contact-photo', $files, $file_name);
            }else{
                $file_name = $contact->photo;
            }

            foreach($request->phone as $key =>$value){
                $phone = Phone::where('id',$request->phone_id[$key])->first();
                if($phone){
                    $phone->phone_number = $value;
                    $phone->type = $request->type[$key];
                    $phone->save();
                }else{
                    $newphone = new Phone();
                    $newphone->contact_id = $contact->id;
                    $newphone->phone_number = $value;
                    $newphone->type = $request->type[$key];
                    $newphone->save();
                }
            }

            foreach($request->email as $key => $value){
                $email = Email::where('id',$request->email_id[$key])->first();
                if($email){
                    $email->email = $request->email[$key];
                    $email->save();
                }else{
                    $newemail = new Email();
                    $newemail->contact_id = $contact->id;
                    $newemail->email = $request->email[$key];
                    $newemail->save();
                }
            }

            if($request->data_origin == null){
                $data_origin = $contact->data_origin_id;
            }else{
                $data_origin = $request->data_origin;
            }

            $contact->data_origin_id = $data_origin;
            $contact->name = $request->name;
            $contact->gender = $request->gender;
            $contact->photo = $file_name;
            $contact->status = $request->status;
            $contact->city = $request->city;
            $contact->address = $request->address;
            $contact->subdistrict = $request->subdistrict;
            $contact->village = $request->village;
            $contact->job = $request->job;
            $contact->date_of_birth = $request->date_of_birth;
            $contact->hobby = $request->hobby;
            $contact->relationship_status = $request->relationship_status;
            $contact->partner_name = $request->partner_name;
            $contact->partner_job = $request->partner_job;
            $contact->number_of_children = $request->number_of_children;
            $contact->contact_record = $request->contact_record;
            $contact->supporting_notes = $request->supporting_notes;
            $contact->save();
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
        $contact = Contact::where('user_id',Auth::user()->id)->where('name','like',"%".$request->name."%")->get();
        $data = [];
        foreach($contact as $value){
            $data_origin = !empty($value->DataOrigin) ? $value->DataOrigin->information : null;
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
            $photo = $value->photo != null ? url('/storage/contact-photo/'.$value->photo) : null;
            $data[] = [
                'id' => $value->id,
                'data_origin' => $data_origin,
                'name' => $value->name,
                'photo' => $photo,
                'status' => $value->status,
                'phone_number' => $phones,
                'email' => $emails
            ];
        }
        return ResponseHelper::responseJson("Success",200,"Successful Search Contact",$data);
    }

    public function destroyContact($id){
        $data = Contact::findOrFail($id);
        Storage::delete('/public/contact-photo/'. $data->photo);
        $data->delete();
        return ResponseHelper::responseJson("Success",200,"Successful delete data",$data);
    }

    public function getStatistik(Request $request){
        $month = $request->month;
        $year = $request->year;

        $new_item_condition = DreamVehicle::whereHas('Contact', function ($query) {
            $query->where('user_id',Auth::user()->id);
        })
        ->where('item_condition','baru')
        ->whereMonth('purchase_date',$month)
        ->whereYear('purchase_date',$year)
        ->where('sold_status','true')->count();

        $used_item_condition = DreamVehicle::whereHas('Contact', function ($query) {
            $query->where('user_id',Auth::user()->id);
        })
        ->where('item_condition','bekas')
        ->whereMonth('purchase_date',$month)
        ->whereYear('purchase_date',$year)
        ->where('sold_status','true')->count();

        $trade_in = DreamVehicle::whereHas('Contact', function ($query) {
            $query->where('user_id',Auth::user()->id);
        })
        ->where('item_condition','trade in')
        ->whereMonth('purchase_date',$month)
        ->whereYear('purchase_date',$year)
        ->where('sold_status','true')->count();

        $total_consumen = Contact::where('user_id',Auth::user()->id)
        ->whereMonth('created_at',$month)
        ->whereYear('created_at',$year)
        ->count();

        $total_males = Contact::where('user_id',Auth::user()->id)
        ->whereMonth('created_at',$month)
        ->whereYear('created_at',$year)
        ->where('gender','laki-laki')->count();

        $total_females = Contact::where('user_id',Auth::user()->id)
        ->whereMonth('created_at',$month)
        ->whereYear('created_at',$year)
        ->where('gender','perempuan')->count();

        $total_cash_sales_types = DreamVehicle::whereHas('Contact', function ($query) {
            $query->where('user_id',Auth::user()->id);
        })
        ->where('payment','cash')
        ->whereMonth('purchase_date',$month)
        ->whereYear('purchase_date',$year)
        ->where('sold_status','true')->count();

        $total_kredit_sales_types = DreamVehicle::where('payment','kredit')
        ->whereMonth('purchase_date',$month)
        ->whereYear('purchase_date',$year)
        ->where('sold_status','true')->count();

        $start_20_30 = Carbon::now()->subYears(30+1)->endOfDay();
        $end_20_30 = Carbon::now()->subYears(20)->endOfDay();
        $age_20_30 = Contact::where('user_id',Auth::user()->id)->whereBetween('date_of_birth', [$start_20_30->toDateString(), $end_20_30->toDateString()])
        ->whereMonth('save_date',$month)
        ->whereYear('save_date',$year)->count();

        $start_31_35 = Carbon::now()->subYears(35+1)->startOfDay();
        $end_31_35 = Carbon::now()->subYears(31)->endOfDay();
        $age_31_35 = Contact::where('user_id',Auth::user()->id)->whereBetween('date_of_birth', [$start_31_35->toDateString(), $end_31_35->toDateString()])
        ->whereMonth('save_date',$month)
        ->whereYear('save_date',$year)->count();

        $start_36_40 = Carbon::now()->subYears(40+1)->startOfDay();
        $end_36_40 = Carbon::now()->subYears(36)->endOfDay();
        $age_36_40 = Contact::where('user_id',Auth::user()->id)->whereBetween('date_of_birth', [$start_36_40->toDateString(), $end_36_40->toDateString()])
        ->whereMonth('save_date',$month)
        ->whereYear('save_date',$year)->count();

        $start_41_45 = Carbon::now()->subYears(45+1)->startOfDay();
        $end_41_45 = Carbon::now()->subYears(41)->endOfDay();
        $age_41_45 = Contact::where('user_id',Auth::user()->id)->whereBetween('date_of_birth', [$start_41_45->toDateString(), $end_41_45->toDateString()])
        ->whereMonth('save_date',$month)
        ->whereYear('save_date',$year)->count();

        $start_46_50 = Carbon::now()->subYears(50+1)->startOfDay();
        $end_46_50 = Carbon::now()->subYears(46)->endOfDay();
        $age_46_50 = Contact::where('user_id',Auth::user()->id)->whereBetween('date_of_birth', [$start_46_50->toDateString(), $end_46_50->toDateString()])
        ->whereMonth('save_date',$month)
        ->whereYear('save_date',$year)->count();

        $start_51 = Carbon::now()->subYears(51)->endOfDay();
        $age_over_51 = Contact::where('user_id',Auth::user()->id)->where('date_of_birth', '<=', $start_51)
        ->whereMonth('save_date',$month)
        ->whereYear('save_date',$year)->count();

        $vehicle_name = VehicleName::withCount([
            'DreamVehicle' => function ($query) use ($month,$year) {
                $query->whereMonth('purchase_date', $month)
                ->whereYear('purchase_date',$year)
                ->where('sold_status','true')
                ->whereHas('Contact', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                });
            }
        ])
        ->having('dream_vehicle_count', '>', 0)
        ->orderBy('dream_vehicle_count','desc')
        ->get();
        $data_vehicle_name = [];
        foreach ($vehicle_name as $value) {
            $data_vehicle_name[] = [
                'vehicle_name' => $value->name,
                'total' => $value->dream_vehicle_count
            ];
        }

        $vehicle_type = VehicleType::withCount([
            'DreamVehicle' => function ($query) use ($month,$year) {
                $query->whereMonth('purchase_date', $month)
                ->whereYear('purchase_date',$year)
                ->where('sold_status','true')
                ->whereHas('Contact', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                });
            }
        ])
        ->having('dream_vehicle_count', '>', 0)
        ->orderBy('dream_vehicle_count','desc')
        ->get();
        $data_vehicle_type = [];
        foreach ($vehicle_type as $value) {
            $data_vehicle_type[] = [
                'vehicle_type' => $value->type,
                'total' => $value->dream_vehicle_count
            ];
        }

        $vehicle_color = VehicleColor::withCount([
            'DreamVehicle' => function ($query) use ($month,$year) {
                $query->whereMonth('purchase_date', $month)
                ->whereYear('purchase_date',$year)
                ->where('sold_status','true')
                ->whereHas('Contact', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                });
            }
        ])
        ->having('dream_vehicle_count', '>', 0)
        ->orderBy('dream_vehicle_count','desc')
        ->get();
        $data_vehicle_color = [];
        foreach ($vehicle_color as $value) {
            $data_vehicle_color[] = [
                'vehicle_color' => $value->color,
                'total' => $value->dream_vehicle_count
            ];
        }

        $data_origins = DataOrigin::withCount([
            'Contact' => function ($query) use ($month,$year) {
                $query->where('user_id',Auth::user()->id)
                ->whereMonth('save_date', $month)
                ->whereYear('save_date',$year);
            }
        ])
        ->having('contact_count', '>', 0)
        ->orderBy('contact_count','desc')
        ->get();
        $data_origin = [];
        foreach ($data_origins as $value) {
            $data_origin[] = [
                'information' => $value->information,
                'total' => $value->contact_count
            ];
        }

        $item_condition = [
            'new_item_condition' => $new_item_condition,
            'used_item_condition' => $used_item_condition,
            'trade_in' => $trade_in,
        ];

        $gender = [
            'male' => $total_males,
            'female' => $total_females,
        ];

        $sales_types = [
            'cash' => $total_cash_sales_types,
            'kredit' => $total_kredit_sales_types,
        ];

        $customers_age = [
            'age_20_30' => $age_20_30,
            'age_31_35' => $age_31_35,
            'age_36_40' => $age_36_40,
            'age_41_45' => $age_41_45,
            'age_46_50' => $age_46_50,
            'age_over_51' => $age_over_51
        ];

        $data = [
            'item_condition' => $item_condition,
            'total_consumen' => $total_consumen,
            'gender' => $gender,
            'sales_types' => $sales_types,
            'customers_age' => $customers_age,
            'car_sold' => $data_vehicle_name,
            'car_type_sold' => $data_vehicle_type,
            'car_color_sold' => $data_vehicle_color,
            'data_origin' => $data_origin
        ];
        return ResponseHelper::responseJson("Success",200,"Successful get statistik",$data);
    }

    public function getCityContact(){
        $contact = Contact::select('city')->where('user_id',Auth::user()->id)->get();
        return ResponseHelper::responseJson("Success",200,"List city contact",$contact);
    }

    public function deletePhoneNumber($id){
        $phone = Phone::findOrFail($id);
        $phone->delete();
        return ResponseHelper::responseJson("Success",200,"Successful delete phone number",$phone);
    }

    public function deleteEmail($id){
        $email = Email::findOrFail($id);
        $email->delete();
        return ResponseHelper::responseJson("Success",200,"Successful delete email",$email);
    }
}
