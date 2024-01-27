<?php

namespace App\Http\Controllers\Customer;

use App\Enums\Category\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use App\Http\Requests\Customer\RegisterRequest;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public string $ControllerName = 'Tài khoản';

    public function __construct()
    {
        view()->share('ControllerName', $this->ControllerName);

        $categories = Category::query()->where('status', '=', StatusEnum::HOAT_DONG)->get(['id', 'name']);
        view()->share('categories', $categories);
    }

    public function register()
    {
        return view('customer.register');
    }

    public function processRegister(RegisterRequest $request)
    {
        $arr = $request->validated();
        $arr['password'] = Hash::make($arr['password']);
        $user = Customer::query()->create($arr);
        event(new Registered($user));
        Auth::guard('customer')->login($user);

        return redirect()->route('verification.notice');
    }

    public function login()
    {
        return view('customer.login');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('login');
    }

    public function processLogin(AuthRequest $request)
    {
        if (Auth::guard('customer')->attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect()->route('customers.home');
        }
        return redirect()->back()->withErrors(['message' => 'Email hoặc Password không chính xác']);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customers.home');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Đã gửi liên kết xác minh!');
    }
}
