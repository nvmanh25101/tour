<?php

use App\Enums\VoucherTypeEnum;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;

if (!function_exists('checkVoucher')) {
    function checkVoucher($request, $model, $applicable_type, $price)
    {
        if ($request->get('voucher_id')) {
            $voucher = Voucher::query()->find($request->get('voucher_id'));
            if (!Auth::guard('customer')->check()) {
                return redirect()->back()->with('error', 'Bạn cần đăng nhập để sử dụng voucher');
            }

            $count = $model::query()->where('customer_id', Auth::guard('customer')->user()->id)
                ->where('voucher_id', $voucher->id)
                ->count();
            if ($count > $voucher->uses_per_customer) {
                return redirect()->back()->with('error', 'Bạn đã sử dụng hết lượt sử dụng voucher');
            }

            if ($voucher->applicable_type !== $applicable_type) {
                return redirect()->back()->with('error', 'Voucher không hợp lệ');
            }

            if ($voucher->uses_per_voucher < 1) {
                return redirect()->back()->with('error', 'Voucher đã hết lượt sử dụng');
            }

            if ($voucher->type === VoucherTypeEnum::PHAN_TRAM) {
                $total = $price - $price * $voucher->value / 100;
            } else {
                $total = $price - $voucher->value;
            }
            --$voucher->uses_per_voucher;
            $voucher->save();

            return $total;
        }
        return $price;
    }
}
