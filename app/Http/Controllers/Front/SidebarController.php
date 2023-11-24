<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;


class SidebarController extends Controller
{
    public function sidebar(){
        // Get featured items
        $featuredItemsCount = Product::where('is_featured','YES')->count();
        $featuredItems = Product::where('is_featured','YES')->get()->toArray();
        // dd($featuredItems); die;
        $featuredItemsChunk = array_chunk($featuredItems, 4);
        // echo "<pre>"; print_r($featuredItemsChunk); die;

        // Get New Products display
        $newProducts = Product::orderBy('id','Desc')->limit(4)->get()->toArray();
        // echo "<pre>"; print_r($newProducts); die;

        $sideBarCategories = Category::get('category_name')->toArray();
        // dd($sideBarCategories); die;

        $sideBarProducts = Brand::get('name')->toArray();
        // dd($sideBarProducts); die;

        $page_name = "listing";
        return view('front.products.listing')->with(compact('page_name','featuredItemsChunk','featuredItemsCount','newProducts','sideBarCategories','sideBarProducts'));
    }
}
