<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function loginAction(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // login
        $data = $request->only(['email', 'password']);
        if (Auth::attempt($data)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', 'Email or password is incorrect.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
