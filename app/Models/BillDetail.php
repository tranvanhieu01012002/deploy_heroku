<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;

    public function bill()
    {
        # code...
        $this->belongsTo('App\Models\Bill','id_bill','id');
    }
    
    protected $table="bill_detail";
}
