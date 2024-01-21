<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderPaymentStatusEnum;
use App\Enums\VoucherStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
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
        $orderCount = Order::query()->where('payment_status',
            OrderPaymentStatusEnum::DA_THANH_TOAN)
            ->whereMonth('created_at', $currentMonth)->count();
        $productCount = Product::query()->count();
        $serviceCount = Service::query()->count();
        $voucherCount = Voucher::query()->where('status', VoucherStatusEnum::HOAT_DONG)->count();
        $appointmentCount = Appointment::query()->whereMonth('created_at', $currentMonth)->count();

        $revenue = Order::query()->where('payment_status',
            OrderPaymentStatusEnum::DA_THANH_TOAN)
            ->whereMonth('created_at', $currentMonth)->sum('total');

        return view('admin.layouts.home', [
            'customerCount' => $customerCount,
            'orderCount' => $orderCount,
            'productCount' => $productCount,
            'serviceCount' => $serviceCount,
            'voucherCount' => $voucherCount,
            'appointmentCount' => $appointmentCount,
            'revenue' => $revenue,
        ]);
    }

}
