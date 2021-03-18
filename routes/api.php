<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Users\ProfileController;
use App\Http\Controllers\Users\ModuleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){
	Route::apiResource('user', UserController::class);
	Route::apiResource('profile', ProfileController::class);
	Route::apiResource('module', ModuleController::class);
});

Route::post('login', [UserController::class,'login']);
// Route::get('get', [UserController::class,'all']);

