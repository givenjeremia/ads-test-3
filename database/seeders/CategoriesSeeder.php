<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            [
                'name'=>'Elektronik'
            ],
            [
                'name'=>'Fashion Pria'
            ],
            [
                'name'=>'Fashion Wanita'
            ],
            [
                'name'=>'Handphone & Tablet'
            ],
            [
                'name'=>'Olahraga'
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
