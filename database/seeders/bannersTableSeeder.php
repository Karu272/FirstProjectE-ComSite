<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class bannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecords = [
            ['id'=>1,'image'=>'banner2.jpg','link'=>'','title'=>'Something 2','alt'=>'Something 2','status'=>1],
            ['id'=>2,'image'=>'banner3.jpg','link'=>'','title'=>'Something 3','alt'=>'Something 3','status'=>1],
            ['id'=>3,'image'=>'banner4.jpg','link'=>'','title'=>'Something 4','alt'=>'Something 4','status'=>1],
        ];
        Banner::insert($bannerRecords);
    }
}
