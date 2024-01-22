<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderPaymentStatusEnum;
use App\Enums\VoucherStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Tour;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public string $ControllerName = 'Trang chủ';

    public function __construct()
    {
        $pageTitle = Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);

    }

    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $customerCount = Customer::query()->count();
        $orderCount = Reservation::query()->where('payment_status',
            OrderPaymentStatusEnum::DA_THANH_TOAN)
            ->whereMonth('created_at', $currentMonth)->count();
        $productCount = Tour::query()->count();
        $serviceCount = Service::query()->count();
        $voucherCount = Voucher::query()->where('status', VoucherStatusEnum::HOAT_DONG)->count();

        $revenue = Reservation::query()->where('payment_status',
            OrderPaymentStatusEnum::DA_THANH_TOAN)
            ->whereMonth('created_at', $currentMonth)->sum('total_price');

        return view('admin.layouts.home', [
            'customerCount' => $customerCount,
            'orderCount' => $orderCount,
            'productCount' => $productCount,
            'serviceCount' => $serviceCount,
            'voucherCount' => $voucherCount,
            'revenue' => $revenue,
        ]);
    }

}
