<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => ['mimes:jpeg,jpg,png'],
            'name' => ['required', 'max:20'],
            'postal_code' => ['required', 'regex:/^[0-9]{3}-[0-9]{4}$/'],
            'city' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'profile_image.mimes' => 'プロフィール画像には、jpegもしくはjpg、pngで入力してください',
            'name.required' => 'お名前を入力してください',
            'name.max' => 'お名前は20文字以内で入力してください',
            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.regex' => 'ハイフンありの８文字で入力してください',
            'city.required' => '住所を入力してください'
        ];
    }
}
