<?php

namespace App\Http\Controllers\Customer;

use App\Enums\OrderPaymentEnum;
use App\Enums\VoucherApplyTypeEnum;
use App\Enums\VoucherStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CheckoutRequest;
use App\Http\Requests\Customer\OrderRequest;
use App\Models\Favorite;
use App\Models\Reservation;
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
        $cart = Favorite::query()->where('customer_id', auth()->id())->first();

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


    public function show($id)
    {
        $order = Order::query()->with(['products', 'voucher', 'admin'])->find($id);
        return view('customer.order_detail', [
            'order' => $order
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
        $cart = Favorite::query()->where('customer_id', auth()->id())->first();
        $arr['cart_id'] = $cart->id;

        $price = 0;
        foreach ($cart->products as $product) {
            $price += $product->price * $product->pivot->quantity;
        }
        $arr['price'] = $price;
        $arr['total'] = checkVoucher($request, Reservation::class, VoucherApplyTypeEnum::SAN_PHAM,
            $price) ?? $price;
        $arr['shipping_fee'] = 0;

        DB::beginTransaction();
        try {
            $order = Reservation::query()->create($arr);

            foreach ($cart->products as $product) {
                $order->products()->attach($product->id, [
                    'name' => $product->name,
                    'quantity' => $product->pivot->quantity,
                    'price' => $product->price,
                ]);
                Product::query()->where('id', $product->id)->decrement('quantity', $product->pivot->quantity);
                Product::query()->where('id', $product->id)->increment('sold', $product->pivot->quantity);
            }
            $cart->products()->detach();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Transaction failed.']);
        }

        return redirect()->route('orders.edit', $order->id)->with([
            'success' => 'Đặt hàng thành công'
        ]);
    }

    public function edit($id)
    {
        $order = Reservation::query()->findOrFail($id);

        return view('customer.checkout', [
            'order' => $order
        ]);

    }

    public function update(CheckoutRequest $request, $id)
    {
        $order = Reservation::query()->findOrFail($id);

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

    public function destroy($id)
    {
        Order::destroy($id);

        return response()->json([
            'success' => 'Hủy thành công',
        ]);
    }
}
