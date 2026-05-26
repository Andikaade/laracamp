<?php

namespace App\Http\Requests\User\Checkout;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $expiredValidation = date('Y-m', time());
        return [
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email,'.Auth::id().'.id',
            'occupation'=>'required|string',
            'phone'=>'required|string',
            'address'=>'required|string',
            //exists:disconts,code -> mencari kode discont dalam colum code
            //delete_at, null -> kalau kode discount terhapus tidak bisa di akses, kalau kode discount ada bisa di akses
            'discount' =>'nullable|string|exists:discounts,code,deleted_at,NULL',
            // 'card_number'=>'required|numeric|digits_between:8,16',
            // 'expired'=>'required|date|date_format:Y-m|after_or_equal:'.$expiredValidation,
            // 'cvc'=>'required|numeric|digits:3'
        ];
    }
}
