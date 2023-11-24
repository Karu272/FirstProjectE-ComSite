<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexBottomRight extends Model
{
    use HasFactory;

    public $table = "index_bottom_right";

    public static function getRightImg(){
        // Get the Img
        $getRightImg = IndexBottomRight::get()->toArray();

        return $getRightImg;
    }
}
