<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListLeft extends Model
{
    use HasFactory;

    public $table = "listleft";

    public static function getListleftImg(){

        $getListleftImg = ListLeft::get()->toArray();

        return $getListleftImg;
    }
}

