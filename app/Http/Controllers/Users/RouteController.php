<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\Routes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    public function index()
    {
        return Routes::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
                'name'          =>  ['required', 'max:255', 'unique:routes'],
                'module_id'    =>  ['required', 'integer'],
            ],
            [
                'name.required'         =>  'Nome obrigatório!',
                'name.max'              =>  'Máximo de caracteres 255 para nome!',
                'name.unique'           =>  'Já existe esse nome!',

                'module_id.required'   =>  'Perfil obrigatório!',
                'module_id.integer'    =>  'Selecione um perfil!'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }

        $route = Routes::create($data);
        return $route;
    }

    public function show($id)
    {
        return Routes::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
                'name'          =>  ['required', 'max:255', 'unique:routes,name,'. $id . ',id'],
                'module_id'    =>  ['required', 'integer'],
            ],
            [
                'name.required'         =>  'Nome obrigatório!',
                'name.max'              =>  'Máximo de caracteres 255 para nome!',
                'name.unique'           =>  'Já existe esse nome!',

                'module_id.required'   =>  'Perfil obrigatório!',
                'module_id.integer'    =>  'Selecione um perfil!'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }

        $route = Routes::findOrFail($id);
        $route->update($data);
        return $route;
    }

    public function destroy($id)
    {
         $route = Routes::findOrFail($id);
         $route->delete();
         return $route;
    }
}
