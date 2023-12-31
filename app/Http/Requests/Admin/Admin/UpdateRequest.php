<?php

namespace App\Http\Requests\Admin\Admin;

use App\Enums\AdminType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
                'max:50'
            ],
            'address' => [
                'required',
                'string',
                'max:255'
            ],
            'phone' => [
                'required',
                'string',
                'min:10',
                'max:15'
            ],
            'role' => [
                'required',
                'integer',
                Rule::in(AdminType::asArray()),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ':attribute không được để trống.',
            'name.max' => ':attribute không được vượt quá :max ký tự.',
            'address.required' => ':attribute không được để trống.',
            'address.max' => ':attribute không được vượt quá :max ký tự.',
            'phone.required' => ':attribute không được để trống.',
            'phone.min' => ':attribute phải có ít nhất :min ký tự.',
            'phone.max' => ':attribute không được vượt quá :max ký tự.',
            'role.required' => ':attribute không được để trống.',
            'role.integer' => ':attribute không chính xác.',
            'role.in' => ':attribute không hợp lệ.',
        ];
    }
}
