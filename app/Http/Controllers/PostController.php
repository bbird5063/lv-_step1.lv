<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // добавили

class PostController extends Controller
{
	public function index() {
		$post = Post::find(1); // id=1, :find - статический метод от Model
		dd($post->title);
	}
}