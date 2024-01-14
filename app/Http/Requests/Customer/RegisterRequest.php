<?php

namespace App\Http\Requests\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            "email" => [
                'required',
                'email',
                'max:50',
                Rule::unique(Customer::class, 'email')
            ],
            "phone" => [
                'required',
                'string',
                'max:15',
            ],
            "password" => [
                'required',
                'string',
                'min:8',
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
            'email.required' => ':attribute không được để trống',
            'email.email' => ':attribute phải là email',
            'email.max' => ':attribute không được vượt quá 50 ký tự',
            'email.unique' => ':attribute đã tồn tại',
            'phone.required' => ':attribute không được để trống',
            'phone.string' => ':attribute phải là chuỗi',
            'phone.max' => ':attribute không được vượt quá 15 ký tự',
            'password.required' => ':attribute không được để trống',
            'password.string' => ':attribute phải là chuỗi',
            'password.min' => ':attribute không được ít hơn 8 ký tự',
            'password.max' => ':attribute không được vượt quá 255 ký tự',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'password' => 'Mật khẩu',
        ];
    }
}
