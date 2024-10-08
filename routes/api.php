<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

/*
Route::group([

	'middleware' => 'api',
	'prefix' => 'auth'

], function ($router) {

	Route::post('login', 'App\Http\Controllers\AuthController@login');
	Route::post('logout', 'App\Http\Controllers\AuthController@logout');
	Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
	Route::post('me', 'App\Http\Controllers\AuthController@me');

});
*/

Route::group([
	'namespace' => 'App\Http\Controllers',
	'middleware' => 'api',
	'prefix' => 'auth'
], function ($router) {
	Route::post('login', 'AuthController@login');
	Route::post('logout', 'AuthController@logout');
	Route::post('refresh', 'AuthController@refresh');
	Route::post('me', 'AuthController@me');
});

Route::group(['namespace' => 'App\Http\Controllers\Post', 'middleware' => 'jwt.auth'], function () {
//Route::group(['namespace' => 'App\Http\Controllers\Post'], function () {
	Route::get('/posts', 'IndexController');
	Route::get('/posts/create', 'CreateController');
	Route::post('/posts', 'StoreController');
	Route::get('/posts/{post}', 'ShowController');
	Route::get('/posts/{post}/edit', 'EditController');
	Route::patch('/posts/{post}', 'UpdateController');
	Route::delete('/posts/{post}', 'DestroyController');
});
