<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        //code ici
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        // $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->roles->contains('name', 'admin')) {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->roles->contains('name', 'user')) {
                
                
                return redirect()->intended('/user/dashboard');
            } else {
                return redirect()->intended('/dashboard');
            }
        } else {
            return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
        }
        // The blog post is valid...
        if(auth()->user()->isAdmin == 0)
        {
            dd("hello Admin");
        }
        elseif(auth()->user()->isAdmin == 1)
        {
            dd("hello User Or Student");
        }
        
    }
    // logout
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login'); // Redirect to the desired page after logout
    }
}
