<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Mail\MailClass;
use App\Mail\SendEmail;
use App\Models\Affiliate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login()
    {
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password')
        ])) {
            $user = Auth::user();
            $data['nama'] = $user->name;
            $data['email'] = $user->email;
            $data['token']  = $user->createToken('nApp')->accessToken;
            return ResponseHelper::responseJson("Success",200,"Successful Login",$data);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,$validator->errors(),null);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['phone'] = $user->phone;
        $data['firebase_token'] = $user->firebase_token;
        $data['token'] = $user->createToken('nApp')->accessToken;
        return ResponseHelper::responseJson("Success",200,"Successful Register",$data);
    }

    public function getProfile(){
        $user = Auth::user();
        $data['name'] = $user->name;
        $data['date_of_birth'] = $user->date_of_birth;
        $data['email'] = $user->email;
        if($user->photo == null){
            $data['photo'] = null;
        }else{
            $data['photo'] = url('/storage/photo/'.$user->photo);
        }
        $data['phone'] = $user->phone;
        $data['province'] = $user->province;
        $data['city'] = $user->city;
        $data['address'] = $user->address;
        $data['workplace'] = $user->workplace;
        return ResponseHelper::responseJson("Success",200,"Profile User",$data);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,$validator->errors(),null);
        }
        $data = Auth::user();
        $files = $request->file('photo');
        if ($files) {
            if($data->photo != null){
                Storage::delete('/public/photo/'. $data->photo);
            }
            $file_name = date('YmdHis').str_replace('', '', $files->getClientOriginalName());
            Storage::disk('local')->putFileAs('public/photo', $files, $file_name);
        }else{
            $file_name = $data->photo;
        }
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->photo = $file_name;
        $data->date_of_birth = $request->date_of_birth;
        $data->workplace = $request->workplace;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->province = $request->province;
        $data->save();
        return ResponseHelper::responseJson("Success",200,"Successful updated data",$data);
    }

    public function logout(Request $request){
        if(Auth::check()){
            $user = Auth::user()->token();
            $user->revoke();
            return ResponseHelper::responseJson("Success",200,"Successful logout",null);
        } else{
            return ResponseHelper::responseJson("Failed",500,"Logout Failed",null);
        }
    }

    public function refreshToken(Request $request)
    {
        $request->user()->tokens()->delete();
        $token = $request->user()->createToken('authToken')->accessToken;
        $data['token'] = $token;
        return ResponseHelper::responseJson("Success",200,"Refresh token",$data);
    }

    public function forgetPassword(Request $request){

        $user = User::where('email',$request->email)->get();
        if($user->count() > 0){
            $token = Str::random(40);
            // $domain = parse_url(url('/'));
            // $domain['host']
            $domain =  'https://demo.ewalabs.com';
            $url = $domain.'/reset-pasword?token='.$token;

            $data['url'] = $url;
            $data['email'] = $request->email;
            $data['title'] = "Password Reset";
            $data['body'] = "Please click on below link to reset your password.";

            Mail::send('forgetPasswordMail',['data' => $data],function($message) use ($data){
                $message->to($data['email'])->subject($data['title']);
            });

            // Mail::to($request->email)->send(new MailClass([
            //     'name' => 'Test',
            //     'email' => $request->email,
            //     'subject' => 'Demo Email',
            //     'message' => 'This is a demo email sent from PHPMailer with Laravel!'
            // ]));

            $date_time = Carbon::now()->format('Y-m-d H:i:s');
            PasswordReset::updateOrCreate(
                ['email' => $request->email],
                [
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => $date_time
                ]
                );
            // $message['message'] = "Please check your mail to reset your password. ";
            return ResponseHelper::responseJson("Success",200,"Please check your mail to reset your password.",null);
        }else{
            return ResponseHelper::responseJson("Failed",404,"User not found",null);
        }
    }

}
