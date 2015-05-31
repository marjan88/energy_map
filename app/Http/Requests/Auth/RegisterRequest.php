<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [

            'name' => 'required',
            'last_name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ];

        foreach ($this->request->get('code') as $key => $val) {
            $rules['code.' . $key] = 'required';
        }

        return $rules;
    }

    public function messages() {
        $messages = [];
        foreach ($this->request->get('code') as $key => $val) {
            $messages['code.' . $key . '.required'] = 'The field "Code ' . $key . '" is required.';
           
        }
        return $messages;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

}
