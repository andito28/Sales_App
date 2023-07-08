<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\SubscriptionPackage;
use Alert;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sales =   $sales = User::where('role','sales')->count();
        $subscriber = Subscriber::where('status','subscriber')->count();
        return view('admin.dashboard',compact('sales','subscriber'));
    }

    public function sales(){
        $sales = User::where('role','sales')->get();
        return view('admin.sales',compact('sales'));
    }

    public function transaksi(){
        $order = Order::orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
        ->orderBy('status')
        ->get();
        return view('admin.transaksi',compact('order'));
    }

    public function showConfirm($id){
        $order = Order::findOrFail($id);
        return response()->json($order);
    }

    public function confirm(Request $request){
    $order = Order::findOrFail($request->id);
    if($request->status == 'success'){
        $package = SubscriptionPackage::findOrFail($request->package_id);
        $month = $package->number_of_month;
        $now = Carbon::now();
        $futureDate = $now->addMonths($month);
        $subscriber =  Subscriber::where('user_id',$order->user_id)->first();
        $subscriber->status = "subscriber";
        $subscriber->validity_period = $futureDate;
        $subscriber->save();
        $order->status = $request->status;
        $order->save();
        Alert::success('Berhasil', 'Berhasil Mengupdate Status');
        return redirect()->route('dashboard.transaksi');
    }



    }
}
