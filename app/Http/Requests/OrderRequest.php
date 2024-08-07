<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'name_receiver' => 'required|string|max:1000',
            'email_receiver' => 'required|string|email|max:255',
             'phone_receiver' => 'required|string|regex:/^\d{10}$/',
            'Address' =>  'required|string|max:255',

        ];
    }

    public function messages(): array
    {
        return [
            'name_receiver.required' => 'Vui lòng nhập tên người nhận.',
            'name_receiver.string' => 'Tên người nhận phải là chuỗi ký tự.',
            'name_receiver.max' => 'Tên người nhận không được quá 1000 ký tự.',
            'email_receiver.required' => 'Vui lòng nhập email của người nhận.',
            'email_receiver.email' => 'Địa chỉ email không hợp lệ.',
            'email_receiver.max' => 'Email không được quá 255 ký tự.',
            'phone_receiver.required' => 'Vui lòng nhập số điện thoại của người nhận.',
            'phone_receiver.regex' => 'Số điện thoại không hợp lệ.',
            'phone_receiver.min' => 'Số điện thoại phải có ít nhất 10 ký tự.',
            'phone_receiver.max' => 'Số điện thoại không được quá 15 ký tự.',
            'address.required' => 'Vui lòng nhập địa chỉ của người nhận.',
            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được quá 255 ký tự.',
        ];
    }
}
