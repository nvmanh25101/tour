<?php

namespace App\Http\Requests\Admin\Time;

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
            'id' => [
                'nullable'
            ],
            "time" => [
                'required',
                'date_format:H:i',
                'unique:times,time'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'time.required' => ':attribute không được để trống.',
            'time.date_format' => ':attribute không hợp lệ.',
            'time.unique' => ':attribute đã tồn tại.',
        ];
    }

    public function attributes(): array
    {
        return [
            'time' => 'Thời gian',
        ];
    }
}
