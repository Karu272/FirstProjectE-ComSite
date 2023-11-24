<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionsRecords = [
                ['id'=>1,'name'=>'Lip','status'=>1],
                ['id'=>2,'name'=>'Face','status'=>1],
                ['id'=>3,'name'=>'Body','status'=>1],
        ];

        Section::insert($sectionsRecords);
    }
}
