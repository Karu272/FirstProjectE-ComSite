<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    public static function getInfo(){
        // Get the info
        $getInfo = Information::get()->toArray();

        return $getInfo;
    }
}
