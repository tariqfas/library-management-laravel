<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
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
}
