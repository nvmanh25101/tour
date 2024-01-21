<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "rating" => [
                'required',
                'integer',
                'min:1',
                'max:5',
            ],
            "content" => [
                'required',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'rating.required' => 'Vui lòng chọn sao đánh giá',
            'rating.integer' => 'Số sao đánh giá phải là số nguyên',
            'rating.min' => 'Số sao đánh giá tối thiểu là 1',
            'rating.max' => 'Số sao đánh giá tối đa là 5',
            'content.required' => 'Vui lòng nhập nội dung đánh giá',
            'content.string' => 'Nội dung đánh giá phải là chuỗi',
        ];
    }

    public function attributes(): array
    {
        return [
            'rating' => 'Số sao đánh giá',
            'content' => 'Nội dung đánh giá',
        ];
    }
}
