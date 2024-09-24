<?php

namespace App\Http\Controllers\Post;

//use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends BaseController // изменили на BaseController
{
	public function __invoke()
	{
		//$posts = Post::all(); // Вместо all() используем paginate()
		$posts = Post::paginate(10); // Вместо all() используем paginate()
		//dd($posts);

		return view('post.posts', compact('posts'));
	}
}