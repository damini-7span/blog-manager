<?php

namespace App\Http\Requests\Post;

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
        $rules = [
            'title' => 'required|unique:posts|max:255',
            'story' => 'required',
        ];

        if (!empty($this->post))
        {
            $rules = [
                'user_id' => 'nullable|exists:users,id',
            ];
        }
        else{
            $rules = [
                'user_id' => 'required|exists:users,id',
            ];
        }
        return $rules;
    }
}
