<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $data = [

            [

                'sku' => 'p001',
                'name' => 'chitarra',
                'price' => '300',
                'cart_id' => null,

            ],
            [

                'sku' => 'p002',
                'name' => 'libro',
                'price' => '30',
                'cart_id' => null,

            ],
            [

                'sku' => 'p003',
                'name' => 'sedia',
                'price' => '150',
                'cart_id' => null,

            ],
            [

                'sku' => 'p004',
                'name' => 'porta',
                'price' => '50',
                'cart_id' => null,

            ],
            [

                'sku' => 'p005',
                'name' => 'divano',
                'price' => '230',
                'cart_id' => null,

            ],
            [

                'sku' => 'p006',
                'name' => 'comodino',
                'price' => '40',
                'cart_id' => null,

            ],
            [

                'sku' => 'p007',
                'name' => 'mazza',
                'price' => '15',
                'cart_id' => null,

            ],
            [

                'sku' => 'p008',
                'name' => 'computer',
                'price' => '350',
                'cart_id' => null,

            ]

        ];



        DB::table('products')->insert($data);
    }
}
