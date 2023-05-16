<?php

namespace App\Helpers;

class ResponseHelper{

    public static function responseJson($status,$code,$message,$data){
        $meta = [
            "message" => $message,
            "code" => $code,
            "status" => $status
        ];
        $response = [
            "meta" => $meta,
            "data" => $data
        ];
        return response()->json($response,$code);
    }

}
