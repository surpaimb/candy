<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Session;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Session::get('logged_in');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password'      => 'required',
            'password'              => 'required|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'current_password'      => 'Please enter your current password',
            'password.required'     => 'Please enter a password',
            'password.min'          => 'Your password must be at least 8 characters',
            'password.confirmed'    => 'Please confirm your password',
        ];
    }
}
