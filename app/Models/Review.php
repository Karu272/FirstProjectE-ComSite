<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $table = "reviews";

    public static function getReview(){
        $getReview = Review::get()->toArray();
        return $getReview;
    }
}
