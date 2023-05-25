<?php

namespace App\Http\Controllers\Api;

use App\Models\Affiliate;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AffiliateController extends Controller
{
    public function getAffiliationAvailable(Request $request){
        $affiliate = Affiliate::where('affiliate_code',$request->code)->first();
        $result = $affiliate != null ? true : false;
        if($affiliate){
            $data['status'] = $result;
            $data['affiliate_code'] = $affiliate->affiliate_code;
        }else{
            $data['status'] = $result;
            $data['affiliate_code'] = null;
        }
        return ResponseHelper::responseJson("Success",200,"Affilate Code",$data);
    }

    public function getAffiliationByUser(){
        $affiliate = Affiliate::where('user_id',Auth::user()->id)->first();
        $data['affiliate_code'] = $affiliate->affiliate_code;
        return ResponseHelper::responseJson("Success",200,"Affilate Code",$data);
    }
}
