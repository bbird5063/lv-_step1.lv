<?php

namespace App\Http\Controllers\Post;

//use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends BaseController // изменили на BaseController
{
	public function __invoke()
	{
		$posts = Post::all();

		return view('post.posts', compact('posts'));
	}
}