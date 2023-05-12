<?php

namespace App\Helpers;

class ResponseHelper{

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
        return response()->json($response,$code);
    }

}
