<?php

use Illuminate\Support\Facades\Route;
use League\Flysystem\PathPrefixer;

//use App\Http\Controllers\Post;
//use App\Http\Controllers\Post\IndexController;

Route::group(['namespace' => 'App\Http\Controllers\Post'], function () {
	Route::get('/posts', 'IndexController')->name('post.index');
	Route::get('/posts/create', 'CreateController')->name('post.create');
	Route::post('/posts', 'StoreController')->name('post.store');
	Route::get('/posts/{post}', 'ShowController')->name('post.show');
	Route::get('/posts/{post}/edit', 'EditController')->name('post.edit');
	Route::patch('/posts/{post}', 'UpdateController')->name('post.update');
	Route::delete('/posts/{post}', 'DestroyController')->name('post.destroy');
});

//use App\Http\Controllers\Admin\Post\IndexController;
//Route::group(['namespace' => 'Admin', 'Prefix' => 'admin'], function () {
//	Route::group(['namespace' => 'Post'], function () {
//		Route::get('/admin/post', [IndexController::class, '__invoke'])->name('admin.post.index'); // работает только так или ниже...
//	});
//});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'Prefix' => 'admin', 'middleware' => 'admin'], function () {
	Route::group(['namespace' => 'Post'], function () {
		Route::get('/admin/post', 'IndexController')->name('admin.post.index');
	}); // работает только так: '/admin/post', а не '/post'
});

//Route::group(['namespace' => 'Admin', 'Prefix' => 'admin'], function () {
//	Route::group(['namespace' => 'Post'], function () {
//		Route::get('/post', 'IndexController')->name('admin.post.index');
//	});
//}); // LVC - не работает

//Route::get('/', 'App\Http\Controllers\MainController@index')->name('main.index'); // работает
use App\Http\Controllers\MainController;

Route::get('/main', [MainController::class, 'index'])->name('main.index'); // работает

Route::get('/about', 'App\Http\Controllers\AboutController@index')->name('about.index');
Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact.index');

//Route::get('/posts/{post}/edit','App\Http\Controllers\PostController@edit')->name('post.edit');
//Route::patch('/posts/{post}','App\Http\Controllers\PostController@update')->name('post.update');

use Illuminate\Support\Facades\Auth; // добавил

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); // добавил
