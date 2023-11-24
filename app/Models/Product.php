<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand','brand_id');
    }

    public function attributes(){
        return $this->hasMany('App\Models\ProductsAttribute');
    }

    public function images(){
        return $this->hasMany('App\Models\ProductsImage');
    }

    public static function getDiscountedPrice($product_id){
        $proDetails = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first()->toArray();
        $catDetails = Category::select('category_discount')->where('id',$proDetails['category_id'])->first()->toArray();
        if($proDetails['product_discount']>0){
            // If Product Discount is added from admin panel
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price']*$proDetails['product_discount']/100);
            // Sale Price = Cost Price - Discount Price
            //    450     =      500 - (500*10/100 = 50)
        }else if($catDetails['category_discount']>0){
            // If Product Discount is not added and category discount added from admin panel
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price']*$catDetails['category_discount']/100);
        }else{
            $discounted_price = 0;
        }
        return $discounted_price;
    }

    public static function getDiscountedAttrPrice($product_id){
        $proAttrPrice = ProductsAttribute::with('product')->where(['product_id'=>$product_id])->first()->toArray();
       // dd($proAttrPrice); die;
        $proDetails = Product::select('product_discount','category_id')->where('id',$product_id)->first()->toArray();
        $catDetails = Category::select('category_discount')->where('id',$proDetails['category_id'])->first()->toArray();
        if($proDetails['product_discount']>0){
            // If Product Discount is added from admin panel
            $final_price = $proAttrPrice['product']['product_price'] - ($proAttrPrice['price']*$proDetails['product_discount']/100);
            $discount = $proAttrPrice['product']['product_price'] - $final_price;
            // Sale Price = Cost Price - Discount Price
            //    450     =      500 - (500*10/100 = 50)
        }else if($catDetails['category_discount']>0){
            // If Product Discount is not added and category discount added from admin panel
            $final_price = $proAttrPrice['product']['product_price'] - ($proAttrPrice['product']['product_price']*$catDetails['category_discount']/100);
            $discount = $proAttrPrice['product']['product_price'] - $final_price;
        }else{
            $final_price = $proAttrPrice['product']['product_price'];
            $discount = 0;
        }
        return array('product_price'=>$proAttrPrice['product']['product_price'],'final_price'=>$final_price,'discount'=>$discount);
    }

    public static function getProductImage($product_id){
        $getProductImage = Product::select('product_image')->where('id',$product_id)->first()->toArray();
        return $getProductImage['product_image'];
    }

}
