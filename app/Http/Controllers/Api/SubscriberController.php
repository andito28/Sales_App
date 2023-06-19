<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Affiliate;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\SubscriptionPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    public function getSubscriptionPackages(){
        $data = SubscriptionPackage::select('id','package_name','normal_price','prices_apply','number_of_month','information')->get();
        return ResponseHelper::responseJson("Success",200,"List subscription packages",$data);
    }

    public function getInfoSubscriber(){
        $today = date('Y-m-d');
        $subscriber = Subscriber::where('user_id',Auth::user()->id)->first();
        if($today <= $subscriber->validity_period){
            if($subscriber->subscriptionPackage != null){
                $subscription_package = [
                    'package_name' => $subscriber->subscriptionPackage->package_name,
                    'normal_price' => $subscriber->subscriptionPackage->normal_price,
                    'prices_apply' => $subscriber->subscriptionPackage->prices_apply,
                    'number_of_month' => $subscriber->subscriptionPackage->number_of_month,
                    'information' => $subscriber->subscriptionPackage->information,
                ];
            }else{
                $subscription_package = null;
            }
            $data['status'] = $subscriber->status;
            $data['validity_period'] = $subscriber->validity_period;
            $data['subscription_package'] = $subscription_package;
        }else{
            $data['status'] = $subscriber->status;
            $data['validity_period'] = $subscriber->validity_period;
            $data['message'] = 'Masa langganan telah kadaluarsa';
        }
        return ResponseHelper::responseJson("Success",200,"Info subscriber",$data);
    }

    public function createSubscriber(){
        $letters = Str::random(5);
            $numbers = '';
            for ($i = 0; $i < 3; $i++) {
                $numbers .= rand(0, 9);
            }
            $randomString = str_shuffle($letters . $numbers);
            $affiliate_code = strtoupper($randomString);
            $affiliate = new Affiliate();
            $affiliate->user_id  = $user->id;
            $affiliate->affiliate_code = $affiliate_code;
            $affiliate->save();
            $data['affiliate_code'] = $user->Affiliate->affiliate_code;
    }
}
