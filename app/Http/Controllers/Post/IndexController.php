<?php

namespace App\Http\Controllers\Post;

//use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\Post\FilterRequest;

use App\Http\Filters\PostFilter; // я добавил

class IndexController extends BaseController // изменили на BaseController
{
	public function __invoke(FilterRequest $request)
	{
		$data = $request->validated();

		$filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
		$posts = Post::filter($filter)->paginate(10);

		return view('post.posts', compact('posts'));
	}
}
