<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            ['id'=>1,'parent_id'=>0,'section_id'=>1,'category_name'=>'Lipgloss','url'=>'Lipgloss','status'=>1],
            ['id'=>2,'parent_id'=>0,'section_id'=>1,'category_name'=>'Lipstick','url'=>'Lipstick','status'=>1],
            ['id'=>3,'parent_id'=>0,'section_id'=>1,'category_name'=>'Lipbalsam','url'=>'Lipbalsam','status'=>1],
            ['id'=>4,'parent_id'=>0,'section_id'=>2,'category_name'=>'Eyeliner','url'=>'Eyeliner','status'=>1],
            ['id'=>5,'parent_id'=>0,'section_id'=>2,'category_name'=>'Facemask','url'=>'Facemask','status'=>1],
            ['id'=>6,'parent_id'=>0,'section_id'=>2,'category_name'=>'Moisturizer','url'=>'Moisturizer','status'=>1],
            ['id'=>7,'parent_id'=>0,'section_id'=>2,'category_name'=>'Washfoam','url'=>'Washfoam','status'=>1],
            ['id'=>8,'parent_id'=>0,'section_id'=>3,'category_name'=>'Washoil','url'=>'Washoil','status'=>1],
            ['id'=>9,'parent_id'=>0,'section_id'=>3,'category_name'=>'Perfume','url'=>'Perfume','status'=>1],
            ['id'=>10,'parent_id'=>0,'section_id'=>3,'category_name'=>'Creams','url'=>'Creams','status'=>1],
        ];
        Category::insert($categoryRecords);
    }
}
