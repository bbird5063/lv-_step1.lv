<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
//use App\Models\PostTag;
use App\Models\Tag;


class UpdateController extends Controller
{
	public function __invoke(Post $post)
	{
		$data = request()->validate([
			'title' => 'string',
			'content' => 'string',
			'image' => 'string',
			'likes' => 'integer',
			'category_id' => '',
			'tags' => '',
		]);

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