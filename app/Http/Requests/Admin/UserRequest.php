<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'street' => 'required|min:3',
            'phone' => 'required',
            'city' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

}
