<?php
namespace App\Http\Controllers\Users;

use App\Models\Users\Modules;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    public function index()
    {
        return Modules::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
                'name'          =>  ['required', 'max:255', 'unique:modules'],
                'profile_id'    =>  ['required', 'integer'],
            ],
            [
                'name.required'         =>  'Nome obrigatório!',
                'name.max'              =>  'Máximo de caracteres 255 para nome!',
                'name.unique'           =>  'Já existe esse nome!',

                'profile_id.required'   =>  'Perfil obrigatório!',
                'profile_id.integer'    =>  'Selecione um perfil!'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }

        $module = Modules::create($data);
        return $module;
    }

    public function show($id)
    {
        return Modules::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
                'name'          =>  ['required', 'max:255', 'unique:modules,name,'. $id . ',id'],
                'profile_id'    =>  ['required', 'integer'],
            ],
            [
                'name.required'         =>  'Nome obrigatório!',
                'name.max'              =>  'Máximo de caracteres 255 para nome!',
                'name.unique'           =>  'Já existe esse nome!',

                'profile_id.required'   =>  'Perfil obrigatório!',
                'profile_id.integer'    =>  'Selecione um perfil!'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }

        $module = Modules::findOrFail($id);
        $module->update($data);
        return $module;
    }

    public function destroy($id)
    {
         $module = Modules::findOrFail($id);
         $module->delete();
         return $module;
    }
}
