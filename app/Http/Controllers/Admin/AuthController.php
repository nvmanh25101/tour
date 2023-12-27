<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function processLogin(Request $request)
    {
        $user = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if (Auth::guard('admin')->attempt($user)) {
            $request->session()->regenerate();
            return redirect('admin/');
        }
        return redirect()->back()->withErrors(['status' => 'Email hoặc Password không chính xác']);
    }
}
