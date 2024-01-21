<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => [
                'required',
                'string',
                'max:50',
            ],
            "phone" => [
                'required',
                'string',
                'max:15',
            ],
            "address" => [
                'required',
                'string',
                'max:255',
            ],
            "district" => [
                'required',
                'string',
                'max:255',
            ],
            "city" => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ':attribute không được để trống',
            'name.string' => ':attribute phải là chuỗi',
            'name.max' => ':attribute không được vượt quá 50 ký tự',
            'phone.required' => ':attribute không được để trống',
            'phone.string' => ':attribute phải là chuỗi',
            'phone.max' => ':attribute không được vượt quá 15 ký tự',
            'address.required' => ':attribute không được để trống',
            'address.string' => ':attribute phải là chuỗi',
            'address.max' => ':attribute không được vượt quá 255 ký tự',
            'district.required' => ':attribute không được để trống',
            'district.string' => ':attribute phải là chuỗi',
            'district.max' => ':attribute không được vượt quá 255 ký tự',
            'city.required' => ':attribute không được để trống',
            'city.string' => ':attribute phải là chuỗi',
            'city.max' => ':attribute không được vượt quá 255 ký tự',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'district' => 'Quận/Huyện',
            'city' => 'Thành phố',
        ];
    }
}
