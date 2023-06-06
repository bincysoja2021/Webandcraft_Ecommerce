<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'name'         => "Soni TV ",
            'cat_id'       => '1',
            'price'        => '5200'
        ]);
         DB::table('product')->insert([
            'name'         => "Oneplas Buds",
            'cat_id'       => '2',
            'price'        => '5000'
        ]);
    }
}
