<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexBottomLeft extends Model
{
    use HasFactory;

    public $table = "index_bottom_left";

    public static function getLeftImg(){
        // Get the Img
        $getLeftImg = IndexBottomLeft::get()->toArray();

        return $getLeftImg;
    }
}
