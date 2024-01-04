<?php

namespace App\Http\Requests\Admin\Product;

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
            'quantity' => [
                'required',
                'integer',
            ],
            "price" => [
                'required',
                'decimal:0,2',
            ],
            'brand' => [
                'required',
                'string',
                'max:255',
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
            'price.required' => ':attribute không được để trống.',
            'price.decimal' => ':attribute không hợp lệ.',
            'quantity.required' => ':attribute không được để trống.',
            'quantity.integer' => ':attribute không hợp lệ.',
            'brand.required' => ':attribute không được để trống.',
            'brand.string' => ':attribute không hợp lệ.',
            'brand.max' => ':attribute không được vượt quá :max ký tự.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên dịch vụ',
            'description' => 'Mô tả sản phẩm',
            'category_id' => 'Danh mục',
            'status' => 'Trạng thái',
            'price' => 'Giá',
            'quantity' => 'Số lượng',
            'brand' => 'Thương hiệu',
        ];
    }
}
