<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
        $rules = [
            'username' => 'required|unique:users|unique:locals',
            'email' => 'required|email|unique:users|unique:locals',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
            'user_type' => 'required',
        ];
        return $rules;
    }
}
