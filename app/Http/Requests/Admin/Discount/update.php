<?php

namespace App\Http\Requests\Admin\Discount;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            // code tidak akan berubah jika id nya masih tetap
            'code' => 'required|string|max:5|unique:discounts,code,' . $this->discount->id,
            // 'code' => 'required|string|max:5|unique:discounts,code,'.this->id.',id',
            'description' => 'nullable|string',
            'percentage' => 'required|min:1|max:100|numeric'
        ];
    }
}
