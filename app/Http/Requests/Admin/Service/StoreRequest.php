<?php

namespace App\Http\Requests\Admin\Service;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
                'max:255'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ':attribute không được để trống'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên dịch vụ',
        ];
    }
}
