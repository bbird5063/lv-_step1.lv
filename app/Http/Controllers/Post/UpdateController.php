<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\Post\UpdateRequest; 


class UpdateController extends Controller
{
	public function __invoke(UpdateRequest $request, Post $post)
	{
		$data = $request->validated();

		if (!isset($data['tags'])) $data['tags'] = []; // РАБОТАЕТ!

		$tags = $data['tags']; // массив $tags в отдельную переменную
		unset($data['tags']); // удаляю из $data массив $tags
		//dd($data, $tags);

		$post->update($data);
		/**
		 * ->attach($tags) не подойдет, т.к. ->attach($tags) добавляет(он добавит еще)
		 * Есть др.метод sync() - он старые привязки удаляет и прибавляет новые
		 * 
		 */
		$post->tags()->sync($tags);

		return redirect()->route('post.show', $post->id);
	}
}