<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create() {
        return view('register');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'password_confirmation'=>'required|same:password',
        ]);

        $user = User::create($request->only(['name','email','password']));

        Auth::login($user);

        return redirect()->route('open');
    }

    public function index(Request $request){
        if (Auth::check())
        {
            echo session()-> get("success");
            return Auth::user();
        }
        else 
        {
            return redirect()->to('/login');
        }

    }

    
    public function logout(Request $request) {
        Auth::logout();
        return view('login');
    }

    public function login(Request $request){
       
        if($request->method() == 'POST')
        {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) 
            {
                return redirect()->route('product.index');
            } 
            else 
            {
                return back()->withError('E-posta adresi veya şifre yanlış.');
            }
        }
        return view('login');
    }
}
