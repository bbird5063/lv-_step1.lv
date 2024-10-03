<?php

namespace App\Http\Controllers\Post;

//use App\Http\Controllers\Controller;
//use App\Models\Post;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource; // добавил сам (ОБЯЗАТЕЛЬНО ЗАГЛАВНАЯ "A"!!!)

class StoreController extends BaseController // изменили на BaseController
{
	public function __invoke(StoreRequest $request)
	{
		$data = $request->validated();

		$post = $this->service->store($data); // идет работа с БД, добавляю '$post = '

		return new PostResource($post);

		//return redirect()->route('post.index');
	}
}
