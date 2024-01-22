<?php

namespace App\Http\Requests\Admin\Tour;

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
            "price_include" => [
                'required',
                'string',
            ],
            "price_exclude" => [
                'required',
                'string',
            ],
            'price_children' => [
                'nullable',
                'string',
            ],
            "duration" => [
                'required',
                'string',
            ],
            'departure_time' => [
                'required',
                'string',
            ],
            'code' => [
                'required',
                'string',
                'max:50',
            ],
            'note' => [
                'required',
                'string',
            ],
            'vehicle' => [
                'required',
                'integer',
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
            'duration.required' => ':attribute không được để trống.',
            'duration.string' => ':attribute không hợp lệ.',
            'price_include.required' => ':attribute không được để trống.',
            'price_exclude.required' => ':attribute không được để trống.',
            'price_children.required' => ':attribute không được để trống.',
            'code.required' => ':attribute không được để trống.',
            'code.max' => ':attribute không được vượt quá :max ký tự.',
            'note.required' => ':attribute không được để trống.',
            'vehicle.required' => ':attribute không được để trống.',
            'vehicle.integer' => ':attribute không hợp lệ.',
            'image.required' => ':attribute không được để trống.',
            'image.file' => ':attribute không hợp lệ.',
            'image.image' => ':attribute không hợp lệ.',
            'departure_time.required' => ':attribute không được để trống.',
            'departure_time.string' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên tour',
            'category_id' => 'Danh mục tour',
            'description' => 'Mô tả tour',
            'duration' => 'Thời gian tour',
            'price_include' => 'Giá tour bao gồm',
            'price_exclude' => 'Giá tour không bao gồm',
            'price_children' => 'Giá tour trẻ em',
            'code' => 'Mã tour',
            'note' => 'Ghi chú',
            'vehicle' => 'Phương tiện',
            'image' => 'Ảnh tour',
            'departure_time' => 'Thời gian khởi hành',
        ];
    }
}
