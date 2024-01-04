<?php

namespace App\Http\Requests\Admin\Product;

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
            "description" => [
                'required',
                'string',
            ],
            "image" => [
                'required',
                'file',
                'image',
            ],
            "price" => [
                'required',
                'decimal:0,2',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1',
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
            'price.required' => ':attribute không được để trống.',
            'price.decimal' => ':attribute không hợp lệ.',
            'quantity.required' => ':attribute không được để trống.',
            'quantity.integer' => ':attribute không hợp lệ.',
            'quantity.min' => ':attribute không hợp lệ.',
            'brand.required' => ':attribute không được để trống.',
            'brand.string' => ':attribute không hợp lệ.',
            'brand.max' => ':attribute không được vượt quá :max ký tự.',
            'image.required' => ':attribute không được để trống.',
            'image.file' => ':attribute không hợp lệ.',
            'image.image' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên sản phẩm',
            'category_id' => 'Danh mục sản phẩm',
            'description' => 'Mô tả sản phẩm',
            'duration' => 'Thời gian sản phẩm',
            'price' => 'Giá sản phẩm',
            'quantity' => 'Số lượng',
            'brand' => 'Thương hiệu',
            'image' => 'Ảnh sản phẩm',
        ];
    }
}
