<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestRequest extends FormRequest
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
            'title'         => ['required','string','max:255', Rule::unique('tests')->ignore($this->id)],
            'key'           => 'required|string|max:255',
            'status'        => 'required|string|max:255',
        ];
    }

    public function  messages()
    {
        return [
          'title.required'      => 'Please enter title',
          'key.required'        => 'Please enter key',
        ];
    }
}
