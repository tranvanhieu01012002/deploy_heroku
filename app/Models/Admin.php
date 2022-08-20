<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public function summaryInfo()
    {
        $data = [
            'users'=> User::count(),
            'products'=> Product::count(),
            'bills'=> Bill::count(),
        ];
        return  $data;
    }
}
