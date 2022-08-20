<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Google\Service\Fitness\Session as FitnessSession;
use Session;
class userController extends Controller
{
    //
    public function SignUpForm(Request $req)
    {
        # code...
        $this->validate(
            $req,
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'fullname' => 'required',
                'repassword' => 'required|same:password'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'email.unique' => 'Email đã có người sử  dụng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'repassword.same' => 'Mật khẩu không giống nhau',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự'
            ]
        );

        $user = new User();
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;

        //check level user in app\models\user
        $user->level = $user->levelUser;
        // $user->level=3;  //level=1: admin; level=2:kỹ thuật; level=3: khách hàng
        $user->save();
        return view('Pages.login');
    }
    public function SignUp()
    {
        # code...
        return view('Pages.SignUp');
    }
   
    public function getLogin()
    {
        # code...
        return view('Pages.login');
    }
    public function postLogin(Request $req)
    {

        # code...
        $this->validate(
            $req,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
                'password.max' => 'Mật khẩu tối đa 20 ký tự'
            ]
        );
        $credentials = ['email' => $req->email, 'password' => $req->password];
        if (Auth::attempt($credentials)) { //The attempt method will return true if authentication was successful. Otherwise, false will be returned.
            $user =  User::where('email',$req->email)->first();
            Session::put('user', $user);
            if($user->level == $user->levelAdmin){
                return redirect('/admin');
            }
            else{
                return redirect('/')->with('status', "Đăng nhập thành công");
            }
        } else {
            return redirect()->back()->with('status', "Đăng nhập khong thành công");
        }
    }
    public function logout()
    {
        # code...
        if(Session::has("user")){
            Session::forget('user');
        } 
        return redirect()->back();
    }
    public function postInputEmail(Request $req)
    {           

        $email = $req->txtEmail;
        //validate

        // kiểm tra có user có email như vậy không

        $user = User::where('email', $email)->get();
        $pass = rand(111111,999999);
        //dd($user);

        if ($user->count() != 0) {

            //gửi mật khẩu reset tới email

            $sentData = [

                'title' => 'Mật khẩu mới của bạn là:',

                'body' =>  $pass

            ];

            \Mail::to($email)->send(new \App\Mail\Mail($sentData));

            Session::flash('message', 'Send email successfully!');
            User::where('email',$email)->update(['password'=>Hash::make($pass)]);
            return view('Pages.login'); //về lại trang đăng nhập của khách

        } else {

            return redirect()->route('getInputEmail')->with('message', 'Your email is not right');
        }
    } //
    
}
