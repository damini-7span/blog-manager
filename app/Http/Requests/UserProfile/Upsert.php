<?php

namespace App\Http\Requests\UserProfile;

use Illuminate\Foundation\Http\FormRequest;

class Upsert extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'nullable|max:20',
            'email' => 'nullable|email',
            'mobile_no' => 'nullable|max:10',
            'information' => 'nullable',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ];
    }
}
