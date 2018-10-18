<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactEnquiryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'                  => 'required',
            'email'                 => 'required|email',
            'enquiry'               => 'required|min:25',
            'g-recaptcha-response'  => 'required|recaptcha'
        ];
    }

    public function messages()
    {
        return [
            'name'                          => 'Please enter your first name',
            'email'                         => 'Please enter your last name',
            'enquiry'                       => 'Please enter the first line of your address',
            'recaptcha'                     => 'Please ensure that you are a human!',
            'g-recaptcha-response.required' => 'Please ensure that you are a human!'
        ];
    }
}
