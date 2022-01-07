<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'full_name'     => 'required',
            'mobile'        => 'required',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }

    public function  messages()
    {
        return [
          'full_name.required'  => 'Please enter your name.',
          'mobile.required'     => 'Please enter your mobile number.',
        ];
    }
}
