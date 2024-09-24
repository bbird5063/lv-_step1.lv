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
		
		$posts = Post::filter($filter)->paginate(10); // фильтр работает

		//dd($filter); // фильтр работает
		//dd($posts); // фильтр работает, назвать надо по другому

		$posts = Post::paginate(10); // Вместо all() используем paginate(), если закоментировать эту строку, то фильтруется
		return view('post.posts', compact('posts'));
	}
}