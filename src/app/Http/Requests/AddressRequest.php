<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'postal_code' => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'city' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'postal_code.required' => '入力必須',
            'postal_code.regex' => 'ハイフンありの8文字以内で入力してください',
            'city.required' => '入力必須',
        ];
    }
}
