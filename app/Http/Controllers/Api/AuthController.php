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
            return $this->responseJson("Success",200,"Berhasil Login",$data);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password-confirm' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $data['token'] = $user->createToken('nApp')->accessToken;
        $data['name'] = $user->name;
        return $this->responseJson("Success",200,"Berhasil Register",$data);
    }

    public function updateProfile(Request $request)
    {
        $data = Auth::user();
        if ($request->file('foto')) {
            $file = $request->file('foto')->store('profile', 'public');
            if ($update->foto && file_exists(storage_path('app/public/' . $update->foto))) {
                Storage::delete('public/' . $update->foto);
                $file = $request->file('foto')->store('profile', 'public');
            }
        }

        $data->update([
            "name" => request('name'),
            "email" => request('email'),
            "foto" => $file,
            'password' => bcrypt($request->password),
            'password-confirmation' => bcrypt($request->password),
        ]);
        return $this->responseJson("Success",200,"Berhasil update data",$data);
    }

    public function logout(Request $request){
        if(Auth::check()){
            $user = Auth::user()->token();
            $user->revoke();
            return $this->responseJson("Success",200,"Berhasil logout",null);
        } else{
            return $this->responseJson("Failed",500,"Gagal Logout",null);
        }
    }
}
