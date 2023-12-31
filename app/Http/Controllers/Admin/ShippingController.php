<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use Illuminate\Support\Facades\Session;

class ShippingController extends Controller
{
    public function viewShippingCharges(){
        Session::put('page','shipping_charges');
        $shipping_charges = ShippingCharge::get()->toArray();

        return view('admin.shipping.view_shipping_charges')->with(compact('shipping_charges'));
    }

    public function addEditShipping(Request $request, $id){
        Session::put('page','shipping_charges');

        if($request->isMethod('POST')){
            $data = $request->all();

            ShippingCharge::where('id',$id)->update([
                '0_500g'=>$data['0_500g'],
                '501_1000g'=>$data['501_1000g'],
                '1001_2000g'=>$data['1001_2000g'],
                '2001_5000g'=>$data['2001_5000g'],
                'above_5000g'=>$data['above_5000g'],
            ]);

            $message = "Shipping charges updated successfully!!!";
            Session::put('success_message',$message);
            return redirect()->back();
        }

        $shippingDetails =ShippingCharge::where('id',$id)->first()->toArray();

        return view('admin.shipping.edit_shipping_charges')->with(compact('shippingDetails'));
    }

    public function updateShippingStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ShippingCharge::where('id',$data['shipping_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'shipping_id'=>$data['shipping_id']]);
        }
    }
}
