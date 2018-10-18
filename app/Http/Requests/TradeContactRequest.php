<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TradeContactRequest extends FormRequest
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
            'contactName'               => 'required',
            'businessName'              => 'required',
            'businessAddress'           => 'required',
            'city'                      => 'required',
            'county'                    => 'required',
            'postCode'                  => 'required',
            'businessEmail'             => 'required',
            'website'                   => 'required',
            'primaryContact'            => 'required',
            'mobileContact'             => 'required',
            'spasOnDisplay'             => 'required',
            'businessTradingLength'     => 'required',
            'g-recaptcha-response'      => 'required|recaptcha'
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
