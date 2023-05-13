<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAssetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $product_assets = [
            [
                'image'=>'logitech-h111.png',
                'product_id'=>1
            ],
            [
                'price'=>'logitech-h111-headset-stereo-single-jack-3-5mm.png',
                'product_id'=>1
            ],
            [
                'price'=>'philips-rice-cooker-inner-pot-2l-bakuhanseki-hd3110-33.png',
                'product_id'=>2
            ],
            [
                'price'=>'philips.png',
                'product_id'=>2
            ],
            [
                'price'=>'philips-rice-cooker.png',
                'product_id'=>2
            ],
            [
                'price'=>'iphone-12-64gb-128gb-256gb.png',
                'product_id'=>3
            ],
            [
                'price'=>'papan-alat-bantu-push-up.png',
                'product_id'=>4
            ],
            [
                'price'=>'jim-joker-sandal-slide-kulit-pria-bold-2s-hitam-hitam.png',
                'product_id'=>5
            ],
           

        ];
        DB::table('product_assets')->insert($product_assets);
    }
}
