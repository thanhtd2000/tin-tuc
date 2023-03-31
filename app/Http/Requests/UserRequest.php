<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|max:24|confirmed',
            'avatar' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Bắt buộc phải nhập',
            'email' => 'Phải nhập đúng định dạng email chứa @',
            'confirmed' => 'Xác nhận mật khẩu phải trùng nhau',
            'min' => 'Phải lớn hơn :min ký tự',
            'max' => 'Phải nhỏ hơn :max ký tự',
        ];
    }
}
