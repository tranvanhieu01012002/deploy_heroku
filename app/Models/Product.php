<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // public function billDetail()
    // {
    //     # code...
    // }
    public function productType()
    {
        # code...
        return $this->belongsTo(ProductType::class,'id_type');
    }
}
