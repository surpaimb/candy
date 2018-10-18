<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstname'             => 'required',
            'lastname'              => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|min:8|confirmed',
            'g-recaptcha-response'  => 'required|recaptcha'
        ];
    }

    public function messages()
    {
        return [
            'firstname'                     => 'Please enter first name',
            'lastname'                      => 'Please enter last name',
            'email'                         => 'Please enter a valid email address',
            'password.required'             => 'Please enter a password',
            'password.min'                  => 'Your password must be at least 8 characters',
            'password.confirmed'            => 'Please confirm your password',
            'recaptcha'                     => 'Please ensure that you are a human!',
            'g-recaptcha-response.required' => 'Please ensure that you are a human!'
        ];
    }
}
