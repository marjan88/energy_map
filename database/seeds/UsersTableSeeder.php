<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		\App\User::create([
			'name' => 'Admin',
			'username' => 'admin',
			'email' => 'rh@neckermann-energien.com',
			'password' => bcrypt('09maya11'),
			'confirmed' => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);

		\App\User::create([
			'name' => 'Test User',
			'username' => 'test_user',
			'email' => 'user@user.com',
			'password' => bcrypt('user'),
			'confirmed' => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);

		TestDummy::times(10)->create('App\User');

	}

}
