<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Session;

class AccountDetailsRequest extends FormRequest
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
            'email'         => 'required|email',
            'firstname'    => 'required',
            'lastname'     => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email'         => 'Please enter a valid emails address',
            'firstname'    => 'Please ensure that you have entered yout first name',
            'lastname'     => 'Please ensure that you have entered yout last name'
        ];
    }
}
