<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;

use App\User;

class AuthController extends Controller
{
	public function __construct(){
        $this->middleware('guest')->except(['Logout']);
        $this->middleware('auth')->only(['Logout']);
    }


    public function Login_View()
    {
    	return view('admin.login');
    }
    public function Register_View()
    {
    	return view('admin.register');
    }


    public function Register(AuthRegisterRequest $request){
    	$email = $request->input('email');
    	$name = $request->input('name');
		$password = bcrypt( $request->input('password'));

    	$user = new User();
    	$user->email = $email;
    	$user->name = $name;
    	$user->password = $password;
    	$user->save();
    	auth()->login($user);
    	return redirect()->route('home');
    }


    public function Login(AuthLoginRequest $request){
    	$email = $request->get('email');
    	$password = $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
           return redirect()->route('home');  
        }else{
            return redirect()->back();
        } 
    }

    public function Logout()
    {
    	auth()->logout();
    	dd('lol');
    	return redirect()->route('home');  
    }


}
