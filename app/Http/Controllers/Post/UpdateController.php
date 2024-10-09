<?php

namespace App\Http\Controllers\Post;

//use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;

class UpdateController extends BaseController
{
	public function __invoke(UpdateRequest $request, Post $post)
	{
		$data = $request->validated();

		$post = $this->service->update($post, $data);

		return $post instanceof Post ? new PostResource($post) : $post; // если $post соответствует модели Post, то возвращаем new PostResource (JSON). Если нет, то возвращаем $post (т.е. сообщение об ошибке $exception->getMessage)

		//return redirect()->route('post.show', $post->id);
	}
}
