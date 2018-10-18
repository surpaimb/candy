<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingAddressRequest extends FormRequest
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
            'address'       => 'required',
            'city'          => 'required',
            'county'        => 'required',
            'zip'           => 'required'
        ];
    }

    public function messages()
    {
        return [
            'address'       => 'Please enter the first line of your address',
            'city'          => 'Please enter your city',
            'county'        => 'Please enter your county',
            'zip'           => 'Please enter your post code',
        ];
    }
}
