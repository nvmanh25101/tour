<?php

namespace App\Http\Requests\Admin\Blog;

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
            "title" => [
                'required',
                'string',
                'max:255'
            ],
            "content" => [
                'required',
                'string',
            ],
            'image' => [
                'required',
                'file',
                'image',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => ':attribute không được để trống.',
            'title.max' => ':attribute không được vượt quá :max ký tự.',
            'content.required' => ':attribute không được để trống.',
            'image.required' => ':attribute không được để trống.',
            'image.file' => ':attribute không hợp lệ1.',
            'image.image' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'content' => 'Nội dung',
            'image' => 'Ảnh',
        ];
    }
}
