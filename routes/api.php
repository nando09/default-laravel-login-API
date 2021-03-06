<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Users\ProfileController;
use App\Http\Controllers\Users\ModuleController;
use App\Http\Controllers\Users\RouteController;
use App\Http\Controllers\Users\RoutesUserController;
use App\Http\Controllers\Users\RoutesProfileController;

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
	Route::apiResource('route', RouteController::class);
	Route::apiResource('routes_user', RoutesUserController::class);
	Route::apiResource('routes_profile', RoutesProfileController::class);
});

Route::post('login', [UserController::class,'login']);
// Route::get('get', [UserController::class,'all']);

