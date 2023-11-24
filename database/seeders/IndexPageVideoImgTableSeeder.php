<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IndexPageVideoImg;

class IndexPageVideoImgTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indexPageVideoImgRecords = [
            ['id'=>1,'indexPageVideoImg'=>'banner2.jpg','link'=>'','title'=>'Something 2','alt'=>'Something 2','status'=>1],
            ['id'=>2,'indexPageVideoImg'=>'banner3.jpg','link'=>'','title'=>'Something 3','alt'=>'Something 3','status'=>1],
            ['id'=>3,'indexPageVideoImg'=>'banner4.jpg','link'=>'','title'=>'Something 4','alt'=>'Something 4','status'=>1],
        ];
        IndexPageVideoImg::insert($indexPageVideoImgRecords);
    }
}
