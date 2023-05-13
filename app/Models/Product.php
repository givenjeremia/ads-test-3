<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\ProductAsset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    public function categories(){
        return $this->belongsTo(Categorie::class,'category_id');
    }

    public function assets(){
        return $this->hasMany(ProductAsset::class,'product_id','id');
    }

    public function tambahAset(){
        return $this->belongsTo(Categorie::class,'category_id');
    }

    public function hapusAset(){
        return $this->belongsTo(Categorie::class,'category_id');
    }
    
}
