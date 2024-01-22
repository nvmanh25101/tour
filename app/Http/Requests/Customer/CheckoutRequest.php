<?php

namespace App\Http\Requests\Customer;

use App\Enums\PaymentEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "payment_method" => [
                'required',
                'integer',
                Rule::in(PaymentEnum::asArray()),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            "payment_method.required" => "Phương thức thanh toán không được để trống",
            "payment_method.integer" => "Phương thức thanh toán phải là số nguyên",
            "payment_method.in" => "Phương thức thanh toán không hợp lệ",
        ];
    }

}
