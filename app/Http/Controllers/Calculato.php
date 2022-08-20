<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Calculato extends Controller
{
    public function showForm(){
        return view("Calculato");
    }
    public function message(){
        return [
          'numb1.required'=>'Ban phai nhap vao',
          'numb2.required'=>'Ban phai nhap vao',
          'numb1.integer'=>'sai kieu',
          'numb2.integer'=>'sai kieu',
        ];
    }
    function Giai(Request $req){
      $validated = $req->validate([
        'numb1' => 'required|integer',
        'numb2' => 'required|integer',
      ],$this->message());
        $numb1=$req->input('numb1');
        $numb2=$req->input('numb2');
        $tinh = $req->input('tinh');

        switch ($tinh) {
            case "cong":
                $kq = $numb1+$numb2;
              
              break;
            case "tru":
                $kq = $numb1-$numb2;
              break;
            case "nhan":
                $kq = $numb1*$numb2;
              break;

              case "chia":
                $kq = $numb1/$numb2;
              break;
              
            default :
             $kq = "không có chi hết";
        }
       
        return view('Calculato',compact('numb1','numb2','kq'));
    }
}
