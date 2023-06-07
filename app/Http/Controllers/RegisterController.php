<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    //
    public function showRegisterForm()
    {
        //
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'confirm' => 'required|min:8',
        ]);
        if($request->password == $request->confirm)
        {
            // dd('password and confirm password are alike');
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            dd('added successfully');
            // return redirect()->route('profile');
        }else{
            dd('password and confirm password are not the same');
        }
    
        // The blog post is valid...
    }
}
