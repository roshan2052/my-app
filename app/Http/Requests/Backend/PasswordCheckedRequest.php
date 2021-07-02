<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\HelperClass\General;

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
            'old_password' =>[ 'required', function($attribute,$value,$fail){
                if(! Hash::check($value, getLoggedInUser()->password)){
                    $fail('old password does not match');
                }
            }],
            'new_password' => 'required|confirmed',

        ];
    }
    public function messages()
    {
        return [
            'old_password.required' => 'Please Enter your old password',
            'new_password.required' => 'Please Enter your New password'
        ];
    }
}
