<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Information;
use App\Models\FAQ;
use App\Models\DdImg;

class AboutUsController extends Controller
{
    public function aboutUs(){
        $getInfo = Information::get()->toArray();
        // Get New Products display
        $newProducts = Product::orderBy('id','Desc')->limit(4)->get()->toArray();
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();

        $sideBarCategories = Category::select('category_name','url')->get()->toArray();

        $sideBarBrands = Brand::select('name','url','description','brand_logo','id')->get()->toArray();
        $getddImg = DdImg::where('status', '1')->get()->toArray();
        return view('front.info.aboutUs')->with(compact('getddImg','randomProducts','getInfo','newProducts','sideBarCategories','sideBarBrands'));
    }

    public function contactUs(){
        $getInfo = Information::get()->toArray();
        // Get New Products display
        $newProducts = Product::orderBy('id','Desc')->limit(4)->get()->toArray();
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();

        $sideBarCategories = Category::select('category_name','url')->get()->toArray();

        $sideBarBrands = Brand::select('name','url','description','brand_logo','id')->get()->toArray();
        $getddImg = DdImg::where('status', '1')->get()->toArray();
        return view('front.info.contactUs')->with(compact('getddImg','randomProducts','getInfo','newProducts','sideBarCategories','sideBarBrands'));
    }

    public function faq(){
        $getddImg = DdImg::where('status', '1')->get()->toArray();
        $getFAQs = FAQ::get()->toArray();
        $getInfo = Information::get()->toArray();
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();
        return view('front.info.faq')->with(compact('getddImg','randomProducts','getInfo','getFAQs'));
    }
}
