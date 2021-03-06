<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\RoutesUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoutesUserController extends Controller
{
    public function index()
    {
        return RoutesUser::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
                'user_id'       =>  ['required', 'integer'],
                'route_id'      =>  ['required', 'integer'],
            ],
            [
                'user_id.required'  =>  'Selecione um usuário!',
                'user_id.integer'   =>  'Selecione um usuário!',

                'route_id.required' =>  'Selecione uma rota!',
                'route_id.integer'  =>  'Selecione uma rota!'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }

        $route = RoutesUser::create($data);
        return $route;
    }

    public function show($id)
    {
        return RoutesUser::where('user_id', $id)->get();
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
                'user_id'       =>  ['required', 'integer'],
                'route_id'      =>  ['required', 'integer'],
            ],
            [
                'user_id.required'  =>  'Selecione um usuário!',
                'user_id.integer'   =>  'Selecione um usuário!',

                'route_id.required' =>  'Selecione uma rota!',
                'route_id.integer'  =>  'Selecione uma rota!'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }

        $route = RoutesUser::findOrFail($id);
        $route->update($data);
        return $route;
    }

    public function destroy($id)
    {
        return RoutesUser::where('user_id', $id)->get();
    }
}
