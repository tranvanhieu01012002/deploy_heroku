<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Car extends Model
{
    use HasFactory;
    protected $table='cars';
    protected $fillable=['model','description','product_on','image','mf_id'];
    public function mf(){
        return $this->belongsTo(Mf::class,'mf_id','id');
    }
}
