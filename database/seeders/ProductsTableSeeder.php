<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            ['id'=>1,'category_id'=>1,'section_id'=>1,'brand_id'=>1,'product_name'=>'Misse','product_code'=>'LG001','product_color'=>'White','product_price'=>560,'product_discount'=>0,'product_weight'=>3,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>2,'category_id'=>1,'section_id'=>1,'brand_id'=>3,'product_name'=>'Boppie','product_code'=>'LG002','product_color'=>'White','product_price'=>350,'product_discount'=>0,'product_weight'=>5,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'YES','status'=>0],
            ['id'=>3,'category_id'=>1,'section_id'=>1,'brand_id'=>4,'product_name'=>'PuuPuu','product_code'=>'LG003','product_color'=>'White','product_price'=>560,'product_discount'=>0,'product_weight'=>3,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>4,'category_id'=>1,'section_id'=>1,'brand_id'=>5,'product_name'=>'PiiPii','product_code'=>'LG004','product_color'=>'White','product_price'=>350,'product_discount'=>0,'product_weight'=>4,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>5,'category_id'=>1,'section_id'=>1,'brand_id'=>2,'product_name'=>'Bibbo','product_code'=>'LG005','product_color'=>'White','product_price'=>350,'product_discount'=>0,'product_weight'=>5,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],

            ['id'=>6,'category_id'=>1,'section_id'=>1,'brand_id'=>1,'product_name'=>'TayTay','product_code'=>'LG006','product_color'=>'White','product_price'=>1200,'product_discount'=>0,'product_weight'=>6,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>7,'category_id'=>1,'section_id'=>1,'brand_id'=>3,'product_name'=>'Kay','product_code'=>'LG007','product_color'=>'White','product_price'=>350,'product_discount'=>0,'product_weight'=>6,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>8,'category_id'=>1,'section_id'=>1,'brand_id'=>4,'product_name'=>'Santanic','product_code'=>'LG008','product_color'=>'White','product_price'=>350,'product_discount'=>0,'product_weight'=>4,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'YES','status'=>0],
            ['id'=>9,'category_id'=>2,'section_id'=>1,'brand_id'=>5,'product_name'=>'Bobianic','product_code'=>'LS001','product_color'=>'White','product_price'=>2350,'product_discount'=>0,'product_weight'=>4,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>10,'category_id'=>2,'section_id'=>1,'brand_id'=>2,'product_name'=>'Crystal','product_code'=>'LS002','product_color'=>'White','product_price'=>350,'product_discount'=>0,'product_weight'=>3,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],

            ['id'=>11,'category_id'=>2,'section_id'=>1,'brand_id'=>1,'product_name'=>'Ruby','product_code'=>'LS003','product_color'=>'White','product_price'=>350,'product_discount'=>0,'product_weight'=>3,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>12,'category_id'=>3,'section_id'=>1,'brand_id'=>2,'product_name'=>'Maztec','product_code'=>'LB001','product_color'=>'White','product_price'=>2225,'product_discount'=>0,'product_weight'=>4,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'YES','status'=>0],
            ['id'=>13,'category_id'=>3,'section_id'=>1,'brand_id'=>5,'product_name'=>'Knas','product_code'=>'LB002','product_color'=>'White','product_price'=>600,'product_discount'=>0,'product_weight'=>4,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>14,'category_id'=>4,'section_id'=>2,'brand_id'=>3,'product_name'=>'Basbom','product_code'=>'LB003','product_color'=>'White','product_price'=>2215,'product_discount'=>0,'product_weight'=>4,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>15,'category_id'=>4,'section_id'=>2,'brand_id'=>2,'product_name'=>'Bicko','product_code'=>'EL001','product_color'=>'White','product_price'=>600,'product_discount'=>0,'product_weight'=>5,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],

            ['id'=>16,'category_id'=>4,'section_id'=>2,'brand_id'=>2,'product_name'=>'Gorgen','product_code'=>'EL002','product_color'=>'White','product_price'=>1500,'product_discount'=>0,'product_weight'=>5,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'YES','status'=>0],
            ['id'=>17,'category_id'=>5,'section_id'=>2,'brand_id'=>3,'product_name'=>'Biff','product_code'=>'EL003','product_color'=>'White','product_price'=>600,'product_discount'=>0,'product_weight'=>5,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>18,'category_id'=>5,'section_id'=>2,'brand_id'=>1,'product_name'=>'Puff','product_code'=>'FM001','product_color'=>'White','product_price'=>400,'product_discount'=>0,'product_weight'=>4,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>19,'category_id'=>5,'section_id'=>2,'brand_id'=>2,'product_name'=>'Mozart','product_code'=>'FM002','product_color'=>'White','product_price'=>700,'product_discount'=>0,'product_weight'=>4,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'YES','status'=>0],
            ['id'=>20,'category_id'=>6,'section_id'=>2,'brand_id'=>4,'product_name'=>'Kicki','product_code'=>'FM003','product_color'=>'White','product_price'=>400,'product_discount'=>0,'product_weight'=>3,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],

            ['id'=>21,'category_id'=>6,'section_id'=>2,'brand_id'=>3,'product_name'=>'Pinky','product_code'=>'MR001','product_color'=>'White','product_price'=>700,'product_discount'=>0,'product_weight'=>7,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>22,'category_id'=>6,'section_id'=>2,'brand_id'=>2,'product_name'=>'Pie','product_code'=>'MR002','product_color'=>'White','product_price'=>2225,'product_discount'=>0,'product_weight'=>7,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>23,'category_id'=>7,'section_id'=>2,'brand_id'=>1,'product_name'=>'Applered','product_code'=>'MR003','product_color'=>'White','product_price'=>225,'product_discount'=>0,'product_weight'=>7,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'YES','status'=>0],
            ['id'=>24,'category_id'=>7,'section_id'=>2,'brand_id'=>1,'product_name'=>'Melonpo','product_code'=>'WF001','product_color'=>'White','product_price'=>2225,'product_discount'=>0,'product_weight'=>7,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>25,'category_id'=>7,'section_id'=>2,'brand_id'=>3,'product_name'=>'Mangobango','product_code'=>'WF002','product_color'=>'White','product_price'=>2225,'product_discount'=>0,'product_weight'=>7,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],

            ['id'=>26,'category_id'=>8,'section_id'=>3,'brand_id'=>4,'product_name'=>'Caramell','product_code'=>'WF003','product_color'=>'White','product_price'=>400,'product_discount'=>0,'product_weight'=>8,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>27,'category_id'=>8,'section_id'=>3,'brand_id'=>5,'product_name'=>'Carro','product_code'=>'Wo001','product_color'=>'White','product_price'=>225,'product_discount'=>0,'product_weight'=>8,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>28,'category_id'=>8,'section_id'=>3,'brand_id'=>1,'product_name'=>'Itti','product_code'=>'Wo002','product_color'=>'White','product_price'=>400,'product_discount'=>0,'product_weight'=>8,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'YES','status'=>0],
            ['id'=>29,'category_id'=>9,'section_id'=>3,'brand_id'=>2,'product_name'=>'Bitty','product_code'=>'Wo003','product_color'=>'White','product_price'=>1200,'product_discount'=>0,'product_weight'=>8,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>30,'category_id'=>9,'section_id'=>3,'brand_id'=>1,'product_name'=>'Kinka','product_code'=>'PF001','product_color'=>'White','product_price'=>1200,'product_discount'=>0,'product_weight'=>9,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],

            ['id'=>31,'category_id'=>9,'section_id'=>3,'brand_id'=>2,'product_name'=>'Sallad','product_code'=>'PF002','product_color'=>'White','product_price'=>2215,'product_discount'=>0,'product_weight'=>5,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>32,'category_id'=>10,'section_id'=>3,'brand_id'=>3,'product_name'=>'Rumpa','product_code'=>'PF003','product_color'=>'White','product_price'=>225,'product_discount'=>0,'product_weight'=>5,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'YES','status'=>0],
            ['id'=>33,'category_id'=>10,'section_id'=>3,'brand_id'=>4,'product_name'=>'Bollibompa','product_code'=>'CRM003','product_color'=>'White','product_price'=>560,'product_discount'=>0,'product_weight'=>4,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
            ['id'=>34,'category_id'=>10,'section_id'=>3,'brand_id'=>1,'product_name'=>'Icke','product_code'=>'CRM003','product_color'=>'White','product_price'=>560,'product_discount'=>0,'product_weight'=>5,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'YES','status'=>0],
            ['id'=>35,'category_id'=>10,'section_id'=>3,'brand_id'=>1,'product_name'=>'Nike','product_code'=>'CRM003','product_color'=>'White','product_price'=>2225,'product_discount'=>0,'product_weight'=>5,'product_video'=>'','product_image'=>'','description'=>'bii bii','is_featured'=>'NO','status'=>0],
        ];
        Product::insert($productRecords);
    }
}
