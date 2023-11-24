<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DdImg extends Model
{
    use HasFactory;

    public $table = "dd_img";

    public static function getddImg(){
        // Get the Img
        $getddImg = DdImg::get()->toArray();

        return $getddImg;
    }
}
