<?php

namespace App\Http\Middleware;

use App\Enums\AdminType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == AdminType::QUAN_LY || $user->role == AdminType::NHAN_VIEN) {
                return $next($request);
            }
//            Auth::logout();
//            return redirect()->route('login');
        }

//        return redirect('login');
    }
}
