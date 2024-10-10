<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{


    public function login(Request $request)
    {
        $request->validate([
            'contact_number' => 'required',
            'password' => 'required',
        ]);



        $employee = Employee::where('em_contactnum', $request->contact_number)->first();


        if (!$employee || !Hash::check($request->password, $employee->em_password)) {
            return back()->with('error', 'Invalid contact number or password');
        }

        if($employee->em_status == 'Inactive'){
            return back()->with('error', 'Your account is inactive');
        }



        Auth::login($employee);

        return redirect()->route('dashboard');

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
