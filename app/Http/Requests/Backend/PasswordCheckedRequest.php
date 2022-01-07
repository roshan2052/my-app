<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class PasswordCheckedRequest extends FormRequest
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
            'old_password' =>[ 'required','string', function($attribute,$value,$fail){
                if(! Hash::check($value, getLoggedInUser()->password)){
                    $fail('old password didn\'t match.');
                }
            }],
            'new_password' => ['required', 'string', 'confirmed','min:8'],

        ];
    }
    public function messages()
    {
        return [
            'old_password.required' => 'Please Enter your old password.',
            'new_password.required' => 'Please Enter your new password.',
            'new_password.min'      => 'Password must be at least 8 charcters.'

        ];
    }
}
