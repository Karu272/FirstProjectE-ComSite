<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsAttribute;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecords = [            

            ['id'=>1,'product_id'=>1,'stock'=>11,'sku'=>'LG001','status'=>0],
            ['id'=>2,'product_id'=>2,'stock'=>11,'sku'=>'LG002','status'=>0],
            ['id'=>3,'product_id'=>3,'stock'=>11,'sku'=>'LG003','status'=>0],
            ['id'=>4,'product_id'=>4,'stock'=>11,'sku'=>'LG004','status'=>0],
            ['id'=>5,'product_id'=>5,'stock'=>11,'sku'=>'LG005','status'=>0],

            ['id'=>6,'product_id'=>6,'stock'=>11,'sku'=>'LG006','status'=>0],
            ['id'=>7,'product_id'=>7,'stock'=>11,'sku'=>'LG007','status'=>0],
            ['id'=>8,'product_id'=>8,'stock'=>11,'sku'=>'LG008','status'=>0],
            ['id'=>9,'product_id'=>9,'stock'=>11,'sku'=>'LS001','status'=>0],
            ['id'=>10,'product_id'=>10,'stock'=>11,'sku'=>'LS002','status'=>0],

            ['id'=>11,'product_id'=>11,'stock'=>11,'sku'=>'LS003','status'=>0],
            ['id'=>12,'product_id'=>12,'stock'=>11,'sku'=>'LB001','status'=>0],
            ['id'=>13,'product_id'=>13,'stock'=>11,'sku'=>'LB002','status'=>0],
            ['id'=>14,'product_id'=>14,'stock'=>12,'sku'=>'LB003','status'=>0],
            ['id'=>15,'product_id'=>15,'stock'=>12,'sku'=>'EL001','status'=>0],

            ['id'=>16,'product_id'=>16,'stock'=>12,'sku'=>'EL002','status'=>0],
            ['id'=>17,'product_id'=>17,'stock'=>12,'sku'=>'EL003','status'=>0],
            ['id'=>18,'product_id'=>18,'stock'=>12,'sku'=>'FM001','status'=>0],
            ['id'=>19,'product_id'=>19,'stock'=>12,'sku'=>'FM002','status'=>0],
            ['id'=>20,'product_id'=>20,'stock'=>12,'sku'=>'FM003','status'=>0],

            ['id'=>21,'product_id'=>21,'stock'=>12,'sku'=>'MR001','status'=>0],
            ['id'=>22,'product_id'=>22,'stock'=>12,'sku'=>'MR002','status'=>0],
            ['id'=>23,'product_id'=>23,'stock'=>12,'sku'=>'MR003','status'=>0],
            ['id'=>24,'product_id'=>24,'stock'=>12,'sku'=>'WF001','status'=>0],
            ['id'=>25,'product_id'=>25,'stock'=>12,'sku'=>'WF002','status'=>0],

            ['id'=>26,'product_id'=>26,'stock'=>13,'sku'=>'WF003','status'=>0],
            ['id'=>27,'product_id'=>27,'stock'=>13,'sku'=>'Wo001','status'=>0],
            ['id'=>28,'product_id'=>28,'stock'=>13,'sku'=>'Wo002','status'=>0],
            ['id'=>29,'product_id'=>29,'stock'=>13,'sku'=>'Wo003','status'=>0],
            ['id'=>30,'product_id'=>30,'stock'=>13,'sku'=>'PF001','status'=>0],

            ['id'=>31,'product_id'=>31,'stock'=>13,'sku'=>'PF002','status'=>0],
            ['id'=>32,'product_id'=>32,'stock'=>13,'sku'=>'PF003','status'=>0],
            ['id'=>33,'product_id'=>33,'stock'=>13,'sku'=>'CRM003','status'=>0],
            ['id'=>34,'product_id'=>34,'stock'=>13,'sku'=>'CRM003','status'=>0],
            ['id'=>35,'product_id'=>35,'stock'=>13,'sku'=>'CRM003','status'=>0],
        ];

        ProductsAttribute::insert($productAttributesRecords);
    }
}
