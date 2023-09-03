<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnquiryRequest extends FormRequest
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
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'mobile' => 'required|digits:10|numeric',
            'address' => 'required',
            'address_2' => 'required',
            'city' => 'required|max:20',
            'pin_code' => 'required|max:10',
            'login_charge' => 'required|numeric',
            'aadhar_number' => 'nullable|max:16',
            'voder_id' => 'nullable|max:15',
            'pan_number' => 'nullable|max:10',
            'other_document' => 'nullable|max:20',
            'pay_mode' => 'required'
        ];
    }
}
