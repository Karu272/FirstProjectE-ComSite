<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecord = [
            ['id'=>1,'name'=>'Rayeallistic','url'=>'Rayeallistic','description'=>'','brand_logo'=>''],
            ['id'=>2,'name'=>'WEE','url'=>'WEE','description'=>'','brand_logo'=>''],
            ['id'=>3,'name'=>'Ever Bilena','url'=>'Ever Bilena','description'=>'','brand_logo'=>''],
            ['id'=>4,'name'=>'Careline','url'=>'Careline','description'=>'','brand_logo'=>''],
            ['id'=>5,'name'=>'Cloud Cosmetics','url'=>'Cloud Cosmetics','description'=>'','brand_logo'=>''],
        ];
        Brand::insert($brandRecord);
    }
}
