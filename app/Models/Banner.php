<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public static function getBanners(){
        // Get banners
        $getBanners = Banner::get()->toArray();
        // dd($getBanners); die;
        return $getBanners;
    }
}
