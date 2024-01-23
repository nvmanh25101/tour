<?php

namespace App\Http\Controllers\Customer;

use App\Enums\Category\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\AccountRequest;
use App\Models\Category;
use App\Models\Customer;

class AccountController extends Controller
{
    public string $ControllerName = 'Tài khoản';

    public function __construct()
    {
        view()->share('ControllerName', $this->ControllerName);

        $categories = Category::query()->where('status', '=', StatusEnum::HOAT_DONG)->get(['id', 'name']);
        view()->share('categories', $categories);
    }

    public function edit($id)
    {
        $account = Customer::query()->with(['reservations'])->findOrFail($id);
        $reservations = $account->reservations()->orderByDesc('id')->paginate(5);

        return view('customer.account', [
            'account' => $account,
            'reservations' => $reservations
        ]);
    }

    public function update(AccountRequest $request, $id)
    {
        $account = Customer::query()->findOrFail($id);
        $account->fill($request->validated());
        $account->save();

        return redirect()->route('account.edit', $account)->with('success', 'Cập nhật tài khoản thành công');
    }
}
