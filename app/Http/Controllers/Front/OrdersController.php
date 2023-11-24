<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Information;
use App\Models\DdImg;
use App\Models\Product;

class OrdersController extends Controller
{
    public function orders(){
    	$orders = Order::with('orders_products')->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
		$getddImg = DdImg::where('status', '1')->get()->toArray();
		$getInfo = Information::get()->toArray();
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();

    	return view('front.orders.orders')->with(compact('randomProducts','getddImg','getInfo','orders'));
    }

    public function orderDetails($id){
    	$orderDetails = Order::with('orders_products')->where('id',$id)->first()->toArray();
		$randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();
		$getddImg = DdImg::where('status', '1')->get()->toArray();
		$getInfo = Information::get()->toArray();

    	return view('front.orders.order_details')->with(compact('randomProducts','getddImg','getInfo','orderDetails'));
    }


}
