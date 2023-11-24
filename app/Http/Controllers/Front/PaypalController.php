<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
Use App\Models\Information;
use App\Models\Product;
use App\Models\DdImg;
use App\Models\CaruselImgs;
use App\Models\Order;
use App\Models\User;

class PaypalController extends Controller
{
    public function paypal(){
        $getInfo = Information::get()->toArray();
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();
        $getddImg = DdImg::where('status', '1')->get()->toArray();
        $getCaruselImg = CaruselImgs::where('status', '1')->get()->toArray();

        if (Session::has('order_id')) {
            $orderDetails = Order::where('id',Session::get('order_id'))->first()->toArray();
            $nameArr = explode(' ', $orderDetails['name']);
            return view('front.paypal.paypal')->with(compact('nameArr','orderDetails','getCaruselImg','getInfo','randomProducts','getddImg'));
        } else {
            return redirect('/cart');
        }
    }

    public function success(){
        $getInfo = Information::get()->toArray();
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();
        $getddImg = DdImg::where('status', '1')->get()->toArray();
        $getCaruselImg = CaruselImgs::where('status', '1')->get()->toArray();

        if (Session::has('order_id')) {
            // Empty the User Cart
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('front.paypal.success')->with(compact('getCaruselImg','getInfo','randomProducts','getddImg'));
        } else {
            return redirect('/cart');
        }
    }

    public function fail(){
        $getInfo = Information::get()->toArray();
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();
        $getddImg = DdImg::where('status', '1')->get()->toArray();
        $getCaruselImg = CaruselImgs::where('status', '1')->get()->toArray();

        return view('front.paypal.fail')->with(compact('getCaruselImg','getInfo','randomProducts','getddImg'));

    }

    public function ipn(Request $request) {
        $data = $request->all();
        if ($data['payment_status']=="Completed"){
            // Process the order
            $order_id = Session::get('order_id');

            // update order status to paid
            Order::where('id', $order_id)->update(['order_status'=>'Paid']);

            $orderDetails = Order::with('orders_products')->where('id',$order_id)->first()->toArray();

            // Send order email
            $email = Auth::user()->email;
            $messageData = [
                'email' => $email,
                'name' => Auth::user()->name,
                'order_id' => $order_id,
                'orderDetails' => $orderDetails,
            ];
            Mail::send('emails.order',$messageData, function($message) use($email){
                $message->to($email)->subject('Order Placed - Rayeallistic.com');
            });

        }

    }


}
