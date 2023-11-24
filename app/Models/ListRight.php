<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListRight extends Model
{
    use HasFactory;

    public $table = "listright";

    public static function getListrightImg() {

        $getListrightImg = ListRight::get()->toArray();

        return $getListrightImg;
    }
}
