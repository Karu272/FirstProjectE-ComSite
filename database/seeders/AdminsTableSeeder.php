<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
         ['id'=>1,'name'=>'admin','type'=>'admin','mobile'=>'980000000','email'=>'ray@admin.com','password'=>'$2y$10$6/EprypaIIxBMzonCGRsvuCxfzn/ryT2DG54sQ4dTXlUKLclnU8zm','image'=>'','status'=>1],
         ['id'=>2,'name'=>'guest','type'=>'admin','mobile'=>'980000000','email'=>'media@admin.com','password'=>'$2y$10$6/EprypaIIxBMzonCGRsvuCxfzn/ryT2DG54sQ4dTXlUKLclnU8zm','image'=>'','status'=>1],

        ];
        DB::table('admins')->insert($adminRecords);
    }
}
