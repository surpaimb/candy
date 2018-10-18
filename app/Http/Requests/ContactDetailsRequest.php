<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactDetailsRequest extends FormRequest
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
            'email'      => 'required|email',
            'phone'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email'         => 'Please enter a email address',
            'email.email'   => 'Please enter a valid email address',
            'phone'         => 'Please enter a phone number',
        ];
    }
}
