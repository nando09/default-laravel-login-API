<?php

namespace App\Http\Controllers\Users;

use App\Models\Users\RoutesProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class RoutesProfileController extends Controller
{
    public function index()
    {
        return RoutesProfile::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
                'profile_id'       =>  ['required', 'integer'],
                'route_id'      =>  ['required', 'integer'],
            ],
            [
                'profile_id.required'  =>  'Selecione um usuário!',
                'profile_id.integer'   =>  'Selecione um usuário!',

                'route_id.required' =>  'Selecione uma rota!',
                'route_id.integer'  =>  'Selecione uma rota!'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }

        $route = RoutesProfile::create($data);
        return $route;
    }

    public function show($id)
    {
        return RoutesProfile::where('profile_id', $id)->get();
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
                'profile_id'       =>  ['required', 'integer'],
                'route_id'      =>  ['required', 'integer'],
            ],
            [
                'profile_id.required'  =>  'Selecione um usuário!',
                'profile_id.integer'   =>  'Selecione um usuário!',

                'route_id.required' =>  'Selecione uma rota!',
                'route_id.integer'  =>  'Selecione uma rota!'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }

        $route = RoutesProfile::findOrFail($id);
        $route->update($data);
        return $route;
    }

    public function destroy($id)
    {
        return RoutesProfile::where('profile_id', $id)->get();
    }
}
