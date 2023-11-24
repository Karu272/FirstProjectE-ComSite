<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaruselImgs extends Model
{
    use HasFactory;

    public $table = "carusel_imgs";

    public static function getCaruselImg(){
        // Get the Img
        $getCaruselImg = CaruselImgs::get()->toArray();

        return $getCaruselImg;
    }
}
