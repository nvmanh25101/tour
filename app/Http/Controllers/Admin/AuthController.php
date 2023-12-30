<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function processLogin(AuthRequest $request)
    {
        if (Auth::guard('admin')->attempt($request->validated())) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->withErrors(['message' => 'Email hoặc Password không chính xác']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
