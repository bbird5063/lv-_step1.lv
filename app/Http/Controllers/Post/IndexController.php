<?php

namespace App\Http\Controllers\Post;

//use App\Http\Controllers\Controller;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Post;

use App\Http\Filters\PostFilter; // я добавил
use App\Http\Resources\Post\PostResource; // добавил сам (ОБЯЗАТЕЛЬНО ЗАГЛАВНАЯ "A"!!!)

class IndexController extends BaseController // изменили на BaseController
{
	public function __invoke(FilterRequest $request)
	{
		/**
		 * это просто для примера, т.к. посты для обычного юзера
		 */
		//$this->authorize('view', auth()->user()); // 1-AdminPolicy@view, 2-авторизованный пользователей

		$data = $request->validated();

		$page = $data['page'] ?? 1; // добавили ('??'-если этого нет)
		$perPage = $data['per_page'] ?? 10; // добавили ('??'-если этого нет)


		$filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
		//$posts = Post::filter($filter)->paginate(10);
		$posts = Post::filter($filter)->paginate($perPage, ['*'], 'page', $page); // вместо 10

		/**
		 * paginate
		 * --------------
		 * $perPage
		 * ['*']
		 * 'page'
		 * $page
		 */

		return PostResource::collection($posts);

		//return view('post.posts', compact('posts'));
	}
}
