<?php

namespace App\Http\Requests\Admin\Voucher;

use App\Enums\VoucherApplyTypeEnum;
use App\Enums\VoucherTypeEnum;
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
            "code" => [
                'required',
                'string',
                'max:50',
                'unique:vouchers,code'
            ],
            "name" => [
                'required',
                'string',
                'max:255'
            ],
            "uses_per_customer" => [
                'required',
                'integer',
                'min:0',
                'lte:uses_per_voucher'
            ],
            "uses_per_voucher" => [
                'required',
                'integer',
                'min:0'
            ],
            "min_spend" => [
                'required',
                'decimal:0,2',
                'min:0'
            ],
            "max_spend" => [
                'nullable',
                'decimal:0,2',
                'min:0'
            ],
            'applicable_type' => [
                'required',
                'integer',
                Rule::in(VoucherApplyTypeEnum::asArray()),
            ],
            'type' => [
                'required',
                'integer',
                Rule::in(VoucherTypeEnum::asArray()),
            ],
            'start_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:today',
                'before_or_equal:end_date',
            ],
            'end_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:start_date',
            ],
            'value' => [
                'required',
                'decimal:0,2',
                'min:0',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => ':attribute không được để trống.',
            'code.max' => ':attribute không được vượt quá :max ký tự.',
            'code.unique' => ':attribute đã tồn tại.',
            'name.required' => ':attribute không được để trống.',
            'name.max' => ':attribute không được vượt quá :max ký tự.',
            'uses_per_customer.required' => ':attribute không được để trống.',
            'uses_per_customer.integer' => ':attribute không hợp lệ.',
            'uses_per_customer.min' => ':attribute ít nhất là 0.',
            'uses_per_customer.lte' => ':attribute phải nhỏ hơn hoặc bằng số lần sử dụng cho mỗi voucher.',
            'uses_per_voucher.required' => ':attribute không được để trống.',
            'uses_per_voucher.integer' => ':attribute không hợp lệ.',
            'uses_per_voucher.min' => ':attribute ít nhất là 0.',
            'min_spend.required' => ':attribute không được để trống.',
            'min_spend.decimal' => ':attribute không hợp lệ.(2 chữ số sau dấu phẩy)',
            'min_spend.min' => ':attribute ít nhất là 0.',
            'max_spend.decimal' => ':attribute không hợp lệ.(2 chữ số sau dấu phẩy)',
            'max_spend.min' => ':attribute ít nhất là 0.',
            'applicable_type.required' => ':attribute không được để trống.',
            'applicable_type.integer' => ':attribute không hợp lệ.',
            'applicable_type.in' => ':attribute không hợp lệ.',
            'start_date.required' => ':attribute không được để trống.',
            'start_date.date_format' => ':attribute không hợp lệ.',
            'start_date.after_or_equal' => ':attribute phải lớn hơn hoặc bằng ngày hiện tại.',
            'start_date.before_or_equal' => ':attribute phải nhỏ hơn hoặc bằng ngày kết thúc.',
            'end_date.required' => ':attribute không được để trống.',
            'end_date.date_format' => ':attribute không hợp lệ.',
            'end_date.after_or_equal' => ':attribute phải lớn hơn hoặc bằng ngày bắt đầu.',
            'type.required' => ':attribute không được để trống.',
            'type.integer' => ':attribute không hợp lệ.',
            'type.in' => ':attribute không hợp lệ.',
            'value.required' => ':attribute không được để trống.',
            'value.decimal' => ':attribute không hợp lệ.(2 chữ số sau dấu phẩy)',
            'value.min' => ':attribute ít nhất là 0.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên voucher',
            'type' => 'Loại giảm giá',
            'code' => 'Mã voucher',
            'uses_per_customer' => 'Số lần sử dụng cho mỗi khách hàng',
            'uses_per_voucher' => 'Số lần sử dụng cho mỗi voucher',
            'min_spend' => 'Số tiền tối thiểu',
            'max_spend' => 'Số tiền tối đa',
            'applicable_type' => 'Loại áp dụng',
            'start_date' => 'Ngày bắt đầu',
            'end_date' => 'Ngày kết thúc',
            'value' => 'Mức giảm giá',
        ];
    }
}
