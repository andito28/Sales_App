<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public static function responseJson($status,$code,$message,$data){
        $meta = [
            "Message" => $message,
            "Code" => $code,
            "Status" => $status
        ];
        $response = [
            "Meta" => $meta,
            "Data" => $data
        ];
        return response()->json($response);
    }

    public function login()
    {
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password')
        ])) {
            $user = Auth::user();
            $data['nama'] = $user->name;
            $data['email'] = $user->email;
            $data['role'] = $user->role;
            $data['token']  = $user->createToken('nApp')->accessToken;
            return $this->responseJson("Success",200,"Successful Login",$data);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = "sales";
        $user = User::create($input);
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['token'] = $user->createToken('nApp')->accessToken;
        return $this->responseJson("Success",200,"Successful Register",$data);
    }

    public function getProfile(){
        $user = Auth::user();
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        if($user->photo == null){
            $data['photo'] = null;
        }else{
            $data['photo'] = url('/storage/photo/'.$user->photo);
        }
        return $this->responseJson("Success",200,"Profile User",$data);
    }

    public function updateProfile(Request $request)
    {
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
        $data->email = $request->email;
        $data->photo = $file_name;
        $data->save();
        return $this->responseJson("Success",200,"Successful updated data",$data);
    }

    public function logout(Request $request){
        if(Auth::check()){
            $user = Auth::user()->token();
            $user->revoke();
            return $this->responseJson("Success",200,"Successful logout",null);
        } else{
            return $this->responseJson("Failed",500,"Logout Failed",null);
        }
    }
}
