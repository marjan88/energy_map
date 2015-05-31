<?php

namespace App\Services;

use App\AssignedRoles;
use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|max:255',
//			'username' => 'required|unique:users|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data) {
        $user = User::create([
                    'name' => $data['name'],
                    'username' => md5(microtime() . env('APP_KEY')),
                    'email' => $data['email'],
                    'last_name' => $data['last_name'],
                    'street' => $data['street'],
                    'city' => $data['city'],
                    'phone' => $data['phone'],
                    'password' => bcrypt($data['password']),
                    'confirmed' => 1,
                    'confirmation_code' => md5(microtime() . env('APP_KEY')),
        ]);
        $assignedrole = new AssignedRoles;
        $assignedrole->user_id = $user->id;
        $assignedrole->role_id = 2;
        $assignedrole->save();
        return $user;
    }

}
