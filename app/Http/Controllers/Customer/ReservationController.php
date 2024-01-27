<?php

namespace App\Http\Controllers\Customer;

use App\Enums\Category\StatusEnum;
use App\Enums\Category\TypeEnum;
use App\Enums\VoucherApplyTypeEnum;
use App\Enums\VoucherStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Reservation\StoreRequest;
use App\Http\Requests\Customer\CheckoutRequest;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Reservation;
use App\Models\Tour;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public string $ControllerName = 'Đơn đặt tour';

    public function __construct()
    {
        view()->share('ControllerName', $this->ControllerName);

        $categories = Category::query()->where('status', '=', StatusEnum::HOAT_DONG)->get(['id', 'name']);
        view()->share('categories', $categories);
    }

    public function show($id)
    {
        $reservation = Reservation::query()->with(['tour', 'voucher', 'admin'])->find($id);

        return view('customer.reservation', [
            'reservation' => $reservation
        ]);
    }

    public function store(StoreRequest $request)
    {
        $arr = $request->validated();
        $timestamp = now()->timestamp;
        $randomNumber = random_int(1000000000, 9999999999);
        $generatedCode = $timestamp.$randomNumber;
        $generatedCode = substr($generatedCode, 0, 10);
        $arr['code'] = $generatedCode;

        $arr['customer_id'] = Auth::guard('customer')->user()->id;
        $tour = Tour::query()->findOrFail($arr['tour_id']);
        $price = $tour->prices[0]->price * $arr['number_people'];
        $arr['price'] = $price;
        $arr['total_price'] = checkVoucher($request, Reservation::class, $price) ?? $price;

        $check_reservation = Reservation::query()->where('customer_id', Auth::guard('customer')->user()->id)
            ->whereDate('departure_date', $arr['departure_date'])
            ->first();
        if ($check_reservation) {
            return redirect()->back()->with('error', 'Bạn đã đặt vào thời gian này');
        }
        $arr['departure_date'] = Carbon::createFromFormat('d-m-Y', $arr['departure_date'])->toDateTimeString();
        $reservation = Reservation::query()->create($arr);

        return redirect()->route('reservations.edit', $reservation->id)->with([
            'success' => 'Đặt tour thành công'
        ]);
    }

    public function edit($id)
    {
        $reservation = Reservation::query()->findOrFail($id);
        return view('customer.checkout', [
            'reservation' => $reservation
        ]);
    }

    public function update(CheckoutRequest $request, $id)
    {
        $order = Reservation::query()->findOrFail($id);
        $order->fill($request->validated());
        $order->save();
        return view('customer.thankyou');

//        return redirect()->route('customers.home');
    }

    public function create(Request $request, $id)
    {
        $vouchers = Voucher::query()->where('status', '=', VoucherStatusEnum::HOAT_DONG)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('uses_per_voucher', '>', 0)
            ->get();

        $tour = Tour::query()->findOrFail($id);
        return view('customer.booking', [
            'tour' => $tour,
            'vouchers' => $vouchers ?? null
        ]);
    }

    public function destroy($id)
    {
        Appointment::destroy($id);

        return response()->json([
            'success' => 'Hủy thành công',
        ]);
    }

}
