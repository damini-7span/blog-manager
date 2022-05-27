<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Signup extends FormRequest
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
            'name' => 'required|max:20',
            'password' => 'required|min:8|confirmed',
            'email' => 'required|email|unique:users',
            'mobile_no' => 'required|max:10',
            'information' => 'nullable',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ];
    }
}
