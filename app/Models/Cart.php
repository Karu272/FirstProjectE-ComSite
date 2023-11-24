<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class Cart extends Model
{
    use HasFactory;

    public static function userCartItems(){
        if(Auth::check()){
            $userCartItems = Cart::with(['product'=>function($query){
                $query->select('id','category_id','product_name','product_code','product_image','product_discount','product_price','product_weight');
            }])->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
        }else{
            $userCartItems = Cart::with(['product'=>function($query){
                $query->select('id','category_id','product_name','product_code','product_image','product_discount','product_price','product_weight');
            }])->where('session_id',Session::get('session_id'))->orderBy('id','Desc')->get()->toArray();

        }
        return $userCartItems;

    }

    // Gets all information from the products table, adding which ones i wanna use with "function "select"" and just add $userCartItems in view in productcontroller
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function getProductAttrPrice($product_id){
        $attrPrice = ProductsAttribute::select('price')->where(['product_id'=>$product_id])->first()->toArray();
        return $attrPrice['price'];
    }

}
