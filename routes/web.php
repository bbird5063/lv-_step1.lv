<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
	return 'Welcome!';
});

//ТАК РАБОТАЕТ БЕЗ ДУРАЦКОГО ПУТИ 'App\Http\Controllers\...':
use App\Http\Controllers\PostController;
Route::get('/posts', [PostController::class, 'index'])->name('post.index');


//Route::get('/posts','App\Http\Controllers\PostController@index')->name('post.index');
Route::get('/posts/create','App\Http\Controllers\PostController@create')->name('post.create');
Route::post('/posts','App\Http\Controllers\PostController@store')->name('post.store');
Route::get('/posts/{post}','App\Http\Controllers\PostController@show')->name('post.show');
Route::get('/posts/{post}/edit','App\Http\Controllers\PostController@edit')->name('post.edit');
Route::patch('/posts/{post}','App\Http\Controllers\PostController@update')->name('post.update');
Route::delete('/posts/{post}','App\Http\Controllers\PostController@destroy')->name('post.destroy');

//===Остальные методы исользовались для изучения и для сайта не нужны===
Route::get('/update','App\Http\Controllers\PostController@update');
Route::get('/delete','App\Http\Controllers\PostController@delete');
Route::get('/first_or_create','App\Http\Controllers\PostController@firstOrCreate');
Route::get('/update_or_create','App\Http\Controllers\PostController@updateOrCreate');

Route::get('/restore','App\Http\Controllers\PostController@restore'); // я добавил

Route::get('/about','App\Http\Controllers\AboutController@index')->name('about.index');
Route::get('/contacts','App\Http\Controllers\ContactController@index')->name('contact.index'); // аргумент name() в единственном числе, как в имени контроллера
Route::get('/main','App\Http\Controllers\MainController@index')->name('main.index');