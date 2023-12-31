<?php

namespace App\Http\Middleware;

use App\Enums\AdminType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            if ($user->role === AdminType::QUAN_LY) {
                return $next($request);
            }
            return redirect()->route('admin.dashboard')->withErrors(['message' => 'Bạn không có quyền truy cập']);
        }

        return redirect('admin.login')->withErrors(['message' => 'Bạn chưa đăng nhập']);
    }
}
