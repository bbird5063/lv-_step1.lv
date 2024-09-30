<?php

namespace App\Http\Controllers\Post;

//use App\Http\Controllers\Controller;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Post;

use App\Http\Filters\PostFilter; // я добавил

class IndexController extends BaseController // изменили на BaseController
{
	public function __invoke(FilterRequest $request)
	{
		/**
		 * это просто для примера, т.к. посты для обычного юзера
		 */
		//$this->authorize('view', auth()->user()); // 1-AdminPolicy@view, 2-авторизованный пользователей

		$data = $request->validated();

		$filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
		$posts = Post::filter($filter)->paginate(10);

		return view('post.posts', compact('posts'));
	}
}
