<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    public $table = "faq";

    public static function getFAQs(){
        // Get the info
        $getFAQs = FAQ::get()->toArray();

        return $getFAQs;
    }
}
