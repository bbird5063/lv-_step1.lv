<?php

namespace App\Http\Controllers\Post;

//use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\Post\PostResource; // добавил сам (ОБЯЗАТЕЛЬНО ЗАГЛАВНАЯ "A"!!!)

class ShowController extends BaseController // изменили на BaseController
{
	public function __invoke(Post $post)
	{
		return new PostResource($post); // добавил

		//return view('post.show', compact('post'));
	}
}