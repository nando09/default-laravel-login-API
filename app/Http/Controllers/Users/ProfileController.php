<?php

namespace App\Http\Controllers\Users;

use App\Models\Users\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return Profile::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
                'name'          =>  ['required', 'max:255', 'unique:profiles']
            ],
            [
                'name.required'         =>  'Nome obrigatório!',
                'name.max'              =>  'Máximo de caracteres 255 para nome!',
                'name.unique'           =>  'Já existe esse nome!'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }

        $profile = Profile::create($data);
        return $profile;
    }

    public function show($id)
    {
        return Profile::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
                'name'          =>  ['required', 'max:255', 'unique:profiles,name,'. $id . ',id']
            ],
            [
                'name.required'         =>  'Nome obrigatório!',
                'name.max'              =>  'Máximo de caracteres 255 para nome!',
                'name.unique'           =>  'Já existe esse nome!'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }

        $profile = Profile::findOrFail($id);
        $profile->update($data);
        return $profile;
    }

    public function destroy($id)
    {
         $profile = Profile::findOrFail($id);
         $profile->delete();
         return $profile;
    }
}
