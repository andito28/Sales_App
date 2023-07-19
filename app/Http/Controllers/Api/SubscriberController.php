<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\UserFee;
use App\Models\Affiliate;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function getPaymentDetail(Request $request){
        try {
            $code_affiliate = Affiliate::where('affiliate_code',$request->affiliate_code)->first();
            $code_affiliate_id = !empty($code_affiliate) ? $code_affiliate->id : null;
            $uniqueNumber = $this->generateUniqueNumber();
            $existingNumber = Order::where('uniq_number', $uniqueNumber)
                ->where('created_at', '>', Carbon::now()->subDays(2))
                ->exists();
            if (!$existingNumber) {
                $data_uniq_number = $uniqueNumber;
            } else {
                while ($existingNumber) {
                    $uniqueNumber = $this->generateUniqueNumber();
                    $existingNumber = Order::where('uniq_number', $uniqueNumber)
                        ->where('created_at', '>', Carbon::now()->subDays(2))
                        ->exists();
                }
                $data_uniq_number = $uniqueNumber;
            }
            $order_affiliate = Order::where('affiliate_id',$code_affiliate_id)
            ->where('user_id',Auth::user()->id)->exists();
            if($code_affiliate && !$order_affiliate){
                $price = $request->package_price;
                $discount = $price * 0.1;
                $total_price = ($price - $discount);
                $user_fee = true;
            }else{
                $total_price = $request->package_price;
                $user_fee = false;
            }
            $price_result = ($total_price - 1000 + $data_uniq_number);
            $data = [
                'total_price' => $price_result,
                'unique_number' => $data_uniq_number,
                'affiliate_id' => $code_affiliate_id,
                'user_fee' => $user_fee
            ];
            return ResponseHelper::responseJson("Success",200,"Payment Detail",$data);

        }catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage]);
        }
    }

    public function createSubscriber(Request $request){
        $data_validate = $request->all();
        $validator = Validator::make($data_validate, [
            'name' => 'required',
            'bank_name' => 'required',
            'total_price' => 'required',
            'evidence_of_transfer' => 'required',
            'subscription_package' => 'required',
            'unique_number' => 'required',
        ]);
        if ($validator->fails()) {
            return ResponseHelper::responseJson("Error",422,$validator->errors(),null);
        }

        if($request->affiliate_id != null && $request->user_fee == true){
            $affiliate = Affiliate::findOrfail($request->affiliate_id);
            $user_fee = new UserFee();
            $user_fee->user_id = $affiliate->User->id;
            $user_fee->fee = 10000;
            $user_fee->save();
        }

        $files = $request->file('evidence_of_transfer');
        if ($files) {
            $file_name = date('YmdHis') . str_replace('', '', $files->getClientOriginalName());
            Storage::disk('local')->putFileAs('public/transfer', $files, $file_name);
        }

        $data = null;
        try {
            DB::transaction(function () use ($request,&$data,&$file_name) {
                $subscription_package_id = $request->subscription_package;
                $name = $request->name;
                $bank_name = $request->bank_name;
                $total_price = $request->total_price;
                $transfer = $request->evidence_of_transfer;
                $package_id = $request->subscription_package;
                $affiliate_id = $request->affiliate_id;
                $unique_number = $request->unique_number;
                $data = new Order();
                $data->user_id  = Auth::user()->id;
                $data->subscription_package_id  = $subscription_package_id;
                $data->name = $name;
                $data->bank_name = $bank_name;
                $data->evidence_of_transfer = $file_name;
                $data->total_price = $total_price;
                $data->uniq_number = $unique_number;
                $data->affiliate_id = $affiliate_id;
                $data->save();
            });
            return ResponseHelper::responseJson("Success",200,"Success create subscriber",$data);
        } catch (\Exception $e) {
            if ($files) {
                Storage::disk('local')->delete('public/transfer/' . $file_name);
            }
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    private function generateUniqueNumber()
    {
        return mt_rand(100, 999);
    }

    public function getFeeByUser(){
        $data = UserFee::select('fee','paid')->where('user_id',Auth::user()->id)->where('status','true')->get();
        return ResponseHelper::responseJson("Success",200,"User Fee",$data);
    }
}
