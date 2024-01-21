<?php

namespace App\Http\Requests\Admin\Category;

use App\Enums\Category\StatusEnum;
use App\Enums\Category\TypeEnum;
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
                'max:100'
            ],
            "description" => [
                'nullable',
                'string',
            ],
            'image' => [
                'required',
                'file',
                'image',
            ],
            'status' => [
                'required',
                'integer',
                Rule::in(StatusEnum::asArray()),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ':attribute không được để trống.',
            'name.max' => ':attribute không được vượt quá :max ký tự.',
            'description.max' => ':attribute không được vượt quá :max ký tự.',
            'image.required' => ':attribute không được để trống.',
            'image.image' => ':attribute phải là ảnh.',
            'status.required' => ':attribute không được để trống.',
            'status.integer' => ':attribute không hợp lệ.',
            'status.in' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên danh mục',
            'description' => 'Mô tả',
            'image' => 'Ảnh',
            'status' => 'Trạng thái',
        ];
    }
}
