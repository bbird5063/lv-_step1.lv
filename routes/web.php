<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
	return 'Welcome!';
});

Route::get('/posts','App\Http\Controllers\PostController@index')->name('post.index'); // аргумент name() в единственном числе, как в имени контроллера
Route::get('/create','App\Http\Controllers\PostController@create');
Route::get('/update','App\Http\Controllers\PostController@update');
Route::get('/delete','App\Http\Controllers\PostController@delete');
Route::get('/first_or_create','App\Http\Controllers\PostController@firstOrCreate');
Route::get('/update_or_create','App\Http\Controllers\PostController@updateOrCreate');

Route::get('/restore','App\Http\Controllers\PostController@restore'); // я добавил

Route::get('/about','App\Http\Controllers\AboutController@index')->name('about.index');
Route::get('/contacts','App\Http\Controllers\ContactController@index')->name('contact.index'); // аргумент name() в единственном числе, как в имени контроллера
Route::get('/main','App\Http\Controllers\MainController@index')->name('main.index');