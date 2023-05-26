<?php

namespace App\Http\Controllers\Api;

use App\Models\Affiliate;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AffiliateController extends Controller
{
    public function checkAffiliationAvailable(Request $request){
        $affiliate = Affiliate::where('affiliate_code',$request->code)->first();
        $message = $affiliate != null ? true : false;
        if($affiliate){
            $status = 'Success';
            $code = 200;
        }else{
            $status = 'Failed';
            $code = 404;
        }
        return ResponseHelper::responseJson($status,$code,$message,null);
    }

    public function getAffiliationByUser(){
        $affiliate = Affiliate::where('user_id',Auth::user()->id)->first();
        $code =  $affiliate != null ? $affiliate->affiliate_code : null;
        $data['affiliate_code'] = $code;
        return ResponseHelper::responseJson("Success",200,"Affilate Code",$data);
    }
}
