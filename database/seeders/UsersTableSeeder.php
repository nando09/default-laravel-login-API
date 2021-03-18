<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create([
			'name'		=>	'Fernando Doe',
			'email'		=>	'fernando@doe.com',
			'username'	=>	'fernando',
			'password'	=>	Hash::make('12345')
		]);
	}
}
