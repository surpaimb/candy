<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFeedbackRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rating'                => 'required',
            'g-recaptcha-response'  => 'required|recaptcha'
        ];
    }

    public function messages()
    {
        return [
            'recaptcha'                     => 'Please ensure that you are a human!',
            'g-recaptcha-response.required' => 'Please ensure that you are a human!'
        ];
    }
}
