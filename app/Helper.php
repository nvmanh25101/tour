<?php

use App\Enums\VoucherTypeEnum;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;

if (!function_exists('checkVoucher')) {
    function checkVoucher($request, $model, $price)
    {
        if ($request->get('voucher_id')) {
            $voucher = Voucher::query()->find($request->validated()['voucher_id']);
            if (!Auth::guard('customer')->check()) {
                return redirect()->back()->with('error', 'Bạn cần đăng nhập để sử dụng voucher');
            }

            $count = $model::query()->where('customer_id', Auth::guard('customer')->user()->id)
                ->where('voucher_id', $voucher->id)
                ->count();
            if ($count > $voucher->uses_per_customer) {
                return redirect()->back()->with('error', 'Bạn đã sử dụng hết lượt sử dụng voucher');
            }

            if ($voucher->uses_per_voucher < 1) {
                return redirect()->back()->with('error', 'Voucher đã hết lượt sử dụng');
            }

            if ($voucher->type === VoucherTypeEnum::PHAN_TRAM) {
                $discount = $price * $voucher->value / 100;
                if ($discount > $voucher->max_spend) {
                    $discount = $voucher->max_spend;
                }

                if ($discount > $price) {
                    $discount = $price;
                }

                $total = $price - $discount;
            } else {
                $voucher_value = $voucher->value;
                if ($voucher_value > $price) {
                    $voucher_value = $price;
                }
                $total = $price - $voucher_value;
            }
            --$voucher->uses_per_voucher;
            $voucher->save();

            return $total;
        }
        return $price;
    }
}
