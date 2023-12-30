<?php

namespace App\Http\Requests\Admin\Category;

use App\Enums\Category\TypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                'max:100'
            ],
            "description" => [
                'nullable',
                'string',
            ],
            'type' => [
                'required',
                'integer',
                Rule::in(TypeEnum::asArray()),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ':attribute không được để trống.',
            'name.max' => ':attribute không được vượt quá :max ký tự.',
            'type.required' => ':attribute không được để trống.',
            'type.integer' => ':attribute không hợp lệ.',
            'type.in' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên danh mục',
            'type' => 'Loại danh mục',
        ];
    }
}
