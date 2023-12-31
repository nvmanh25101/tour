<?php

namespace App\Http\Requests\Admin\Time;

use App\Enums\ServiceStatusEnum;
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
                'max:255'
            ],
            "description" => [
                'required',
                'string',
            ],
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',

            ],
            'status' => [
                'required',
                'integer',
                Rule::in(ServiceStatusEnum::asArray()),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ':attribute không được để trống.',
            'name.max' => ':attribute không được vượt quá :max ký tự.',
            'description.required' => ':attribute không được để trống.',
            'description.string' => ':attribute không hợp lệ.',
            'category_id.required' => ':attribute không được để trống.',
            'category_id.integer' => ':attribute không hợp lệ.',
            'category_id.exists' => ':attribute không tồn tại.',
            'status.required' => ':attribute không được để trống.',
            'status.integer' => ':attribute không hợp lệ.',
            'status.in' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên dịch vụ',
            'description' => 'Mô tả dịch vụ',
            'category_id' => 'Danh mục dịch vụ',
            'status' => 'Trạng thái',
        ];
    }
}
