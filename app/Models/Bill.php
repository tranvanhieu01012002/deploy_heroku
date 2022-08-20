<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = ['id_customer', 'date_order', 'total', 'payment', 'note'];

    public function billDetail()
    {
        return $this->hasOne('App\Models\BillDetail', 'id_bill', 'id');
    }
    public function customer()
    {
        # code...
        return $this->belongsTo(Customer::class,'id_customer','id');
    }
}
