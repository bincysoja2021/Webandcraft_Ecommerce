<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'name'         => "Television"
        ]);
         DB::table('category')->insert([
            'name'         => "Headphones"
        ]);
        DB::table('category')->insert([
            'name'         => "Phone"
        ]);
    }
}
