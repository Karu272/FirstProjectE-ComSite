<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\IndexPageVideoImg;
use App\Models\CaruselImgs;
use App\Models\IndexBottomLeft;
use App\Models\IndexBottomRight;
use App\Models\Information;
use App\Models\DdImg;

class IndexController extends Controller
{
    public function index(){
        $getddImg = DdImg::where('status', '1')->get()->toArray();
        $getBanners = Banner::where('status', '1')->first()->toArray();
        $getVideoImg = IndexPageVideoImg::where('status', '1')->first()->toArray();
        $getCaruselImg = CaruselImgs::where('status', '1')->get()->toArray();
        $getLeftImg = IndexBottomLeft::where('status', '1')->first()->toArray();
        $getRightImg = IndexBottomRight::where('status', '1')->first()->toArray();
        // Get featured Items
        $featuredItemsCount = Product::where('is_featured','YES')->count();
        $featuredItems = Product::where('is_featured','YES')->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems, 6);
        // Get New Products display
        $newProducts = Product::with('Brand')->orderBy('id','Desc')->limit(4)->get()->toArray();
        $moreProducts = Product::select('product_video','product_image','product_price','product_name')->get()->toArray();
        $getInfo = Information::get()->toArray();
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();

        $page_name = "index";
        return view('front.index')->with(compact('getddImg','getInfo','getCaruselImg','getRightImg','getLeftImg','getVideoImg','getBanners','page_name','featuredItemsChunk','featuredItemsCount','newProducts','moreProducts','randomProducts'));

    }
}
