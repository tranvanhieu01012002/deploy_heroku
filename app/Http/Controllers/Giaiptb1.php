<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class Giaiptb1 extends Controller
{
    function Giai(Request $req){
        $a=$req->input('a');
        $b=$req->input('b');
        if($a==0)
            if($b==0)
                $kq="pt co vo so nghiem";
            else 
                $kq="phuong trinh vo nghiem";
        else $kq="phuong trinh co nghiem x=".$b/$a;
        return view('Ptb1',compact('a','b','kq'));

        // $validator = Validator::make(request->all(),[

        // ]);
    }
}
