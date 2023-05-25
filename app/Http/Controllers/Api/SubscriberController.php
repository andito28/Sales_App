<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
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
