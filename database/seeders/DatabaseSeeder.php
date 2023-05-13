<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ProductsSeeder;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\ProductAssetsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CategoriesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ProductAssetsSeeder::class);



    }
}
