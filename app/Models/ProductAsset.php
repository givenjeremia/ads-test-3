<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAsset extends Model
{
    use HasFactory;
    protected $table = 'product_assets';

    public function products(){
        return $this->belongsTo(Product::class,'product_id');
    }

}
