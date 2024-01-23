<?php

namespace App\Http\Requests\Admin\Tour;

use App\Models\Tour;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DestroyRequest extends FormRequest
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
            [
                'course' => [
                    'required',
                    Rule::exists(Tour::class, 'id'),
                ],
            ]
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'tour' => $this->route('tour')->id
        ]);
    }

    public function attributes(): array
    {
        return [
            'tour' => 'Tour',
        ];
    }

    public function messages(): array
    {
        return [
            'tour.required' => ':attribute không được để trống',
            'tour.exists' => ':attribute không tồn tại',
        ];
    }
}
