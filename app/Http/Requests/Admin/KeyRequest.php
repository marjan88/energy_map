<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class KeyRequest extends Request {

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
			'code' => 'required|min:5',
		];
	}
        
        public function messages() {
        $messages = [
            'required' => 'The field "Register Code" is required. Please click the "Create Random Code"',
        ];
        
        return $messages;
    }

}
