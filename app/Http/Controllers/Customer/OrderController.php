<?php

namespace App\Http\Controllers\Customer;

use App\Enums\OrderPaymentEnum;
use App\Enums\VoucherApplyTypeEnum;
use App\Enums\VoucherStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CheckoutRequest;
use App\Http\Requests\Customer\OrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Voucher;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public string $ControllerName = 'Giỏ hàng';

    public function __construct()
    {
        view()->share('ControllerName', $this->ControllerName);
    }

    public function index()
    {
        $cart = Cart::query()->where('customer_id', auth()->id())->first();

        $vouchers = Voucher::query()->where('status', '=', VoucherStatusEnum::HOAT_DONG)
            ->where('applicable_type', VoucherApplyTypeEnum::SAN_PHAM)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('uses_per_voucher', '>', 0)
            ->get();

        return view('customer.order', [
            'cart' => $cart,
            'vouchers' => $vouchers
        ]);
    }

    public function store(OrderRequest $request)
    {
        $arr = $request->validated();

        $timestamp = now()->timestamp;
        $randomNumber = random_int(1000000000, 9999999999);
        $generatedCode = $timestamp.$randomNumber;
        $generatedCode = substr($generatedCode, 0, 10);
        $arr['code'] = $generatedCode;

        $arr['address_receiver'] = $arr['address'].', '.$arr['district'].', '.$arr['city'];

        $arr['customer_id'] = Auth::guard('customer')->user()->id;
        $cart = Cart::query()->where('customer_id', auth()->id())->first();
        $arr['cart_id'] = $cart->id;

        $price = 0;
        foreach ($cart->products as $product) {
            $price += $product->price * $product->pivot->quantity;
        }
        $arr['price'] = $price;
        $arr['total'] = checkVoucher($request, Order::class, VoucherApplyTypeEnum::SAN_PHAM,
            $price) ?? $price;
        $arr['shipping_fee'] = 0;

        DB::beginTransaction();
        try {
            $order = Order::query()->create($arr);

            foreach ($cart->products as $product) {
                $order->products()->attach($product->id, [
                    'name' => $product->name,
                    'quantity' => $product->pivot->quantity,
                    'price' => $product->price,
                ]);
            }
            $cart->products()->detach();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Transaction failed.']);
        }

        return redirect()->route('orders.edit', $order->id);
    }

    public function edit($id)
    {
        $order = Order::query()->findOrFail($id);

        return view('customer.checkout', [
            'order' => $order
        ]);

    }

    public function update(CheckoutRequest $request, $id)
    {
        $order = Order::query()->findOrFail($id);

        if ($request->payment_method == OrderPaymentEnum::CHUYEN_KHOAN) {
            $vnpay = new VnpayController();
            $vnpay->create($order);
        } else {
            $order->fill($request->validated());
            $order->save();
            return view('customer.thankyou');
        }

//        return redirect()->route('customers.home');
    }
}
