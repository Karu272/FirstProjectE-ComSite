<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexPageVideoImg extends Model
{
    use HasFactory;

    public $table = 'index_page_video_img';

    public static function getVideoImg(){
        // Get the img
        $getVideoImg = IndexPageVideoImg::get()->toArray();
        // dd($getVideoImg); die;
        return $getVideoImg;
    }
}
