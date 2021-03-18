<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Models\Users\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
	public function login(Request $request){
		$user= User::where('email', $request->email)->first();
		if (!$user || !Hash::check($request->password, $user->password)) {
			return response('message' => ['Os credenciais estão incorretas, por favor tente novamente!']);
		}

		$token = $user->createToken('my-app-token')->plainTextToken;

		$response = [
			'user' => $user,
			'token' => $token
		];

		return response($response, 201);
	}

	public function index()
	{
		return User::all();
	}

	public function store(Request $request)
	{
		$data = $request->all();
		$validator = Validator::make($data, [
				'name'			=>	['required', 'max:255'],
				'username'		=>	['required', 'max:255', 'unique:users'],
				'email'			=>	['required', 'max:255', 'unique:users'],
				'id_profile'	=>	['required', 'integer'],
			],
			[
				'name.required'			=>	'Nome obrigatório!',
				'name.max'				=>	'Máximo de caracteres 255 para nome!',

				'username.required'		=>	'Usuario obrigatório!',
				'username.max'			=>	'Máximo de caracteres 255 para usuario!',
				'username.unique'		=>	'Já existe esse usuarios!',

				'email.required'		=>	'Email obrigatório!',
				'email.max'				=>	'Máximo de caracteres 255 para email!',
				'email.unique'			=>	'Já existe esse email!',

				'id_profile.required'	=>	'Perfil obrigatório!',
				'id_profile'			=>	'Selecione um perfil!'
			]
		);

		if ($validator->fails()) {
			$errors = $validator->errors();
			return $errors;
		}

		return User::create($data);
	}

	public function show($id)
	{
		return User::findOrFail($id);
	}

	public function update(Request $request, $id)
	{
		$data = $request->all();
		$validator = Validator::make($data, [
				'name'			=>	['required', 'max:255'],
				'username'		=>	['required', 'max:255', 'unique:users,username,'. $id . ',id'],
				'email'			=>	['required', 'max:255', 'unique:users,email,'. $id . ',id'],
				'id_profile'	=>	['required', 'integer'],
			],
			[
				'name.required'			=>	'Nome obrigatório!',
				'name.max'				=>	'Máximo de caracteres 255 para nome!',

				'username.required'		=>	'Usuario obrigatório!',
				'username.max'			=>	'Máximo de caracteres 255 para usuario!',
				'username.unique'		=>	'Já existe esse usuarios!',

				'email.required'		=>	'Email obrigatório!',
				'email.max'				=>	'Máximo de caracteres 255 para email!',
				'email.unique'			=>	'Já existe esse email!',

				'id_profile.required'	=>	'Perfil obrigatório!',
				'id_profile'			=>	'Selecione um perfil!'
			]
		);

		if ($validator->fails()) {
			$errors = $validator->errors();
			return $errors;
		}

		$user = User::findOrFail($id);
		$user->update($data);
		return $user;
	}

	public function destroy($id)
	{
		 $user = User::findOrFail($id);
		 $user->delete();
		 return $user;
	}
}
