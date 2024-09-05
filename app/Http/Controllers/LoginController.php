<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function login(Request $request)
    {
        $request->validate([
            'contact_number' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('contact_number', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->Position === 'Manager' || $user->Position === 'System Administrator') {
                return redirect()->intended('admin');
            } elseif ($user->Position === 'Receptionist') {
                return redirect()->intended('receptionist/booking');
            }

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }
}
