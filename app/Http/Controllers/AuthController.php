<?php

namespace App\Http\Controllers;

use illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Hash;

class AuthController extends Controller
{

    public function login()
    {
        return view("auth.login");
    }
    public function register()
    {
        return view("auth.register");
    }
    public function signin(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $credentials = $request->only("email","password");

        if(Auth::attempt($credentials))
        {
            return redirect()->intended(route("salary.index"))->with("success","Signed in successfully.");
        }

        return redirect("login")->withErrors(['InvalidCredentials' => 'Login Details are Invalid']);
    }
    
    public function signup(Request $request)
    {
        $request->validate([
            "email"=> "required|email|unique:users",
            "password"=> "required",
            "name" => "required",
        ]);

        $user = User::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=> Hash::make($request->password),
        ]);
        
        if($user)
        {
            Auth::login($user);
            return redirect()->route('salary.index')->with("success", "Account created successfully.");
        }
        return redirect('register')->withErrors(['Wrong'=> 'Something went wrong.']);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
  
        return redirect('login');
    }
}
