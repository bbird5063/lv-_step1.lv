<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class StoreController extends Controller
{
	public function __invoke()
	{
		$data = request()->validate([
			'title' => 'string',
			'content' => 'string',
			'image' => 'string',
			'likes' => 'integer',
			'category_id' => '',
			'tags' =>'',
		]);


		//// 1. ПЕРВЫЙ СПОСОБ
		//// Разделяю массив обычных переменных $data и массив $tags:
		//$tags = $data['tags']; // массив $tags в отдельную переменную
		//unset($data['tags']); // удаляю из $data массив $tags
		////dd($data, $tags);

		//$post = Post::create($data); // мы получим новый пост, а из него id
		//foreach ($tags as $tag) {
		//	PostTag::firstOrCreate([ // firstOrCreate- если нашел, то верни. Если не нашел, то создвй.
		//		'tag_id' => $tag,
		//		'post_id' => $post->id,
		//	]);

		// 2. БОЛЕЕ ПРОФЕССИОНАЛЬНЫЙ СПОСОБ (->attach())
		// Разделяю массив обычных переменных $data и массив $tags:
		
		//dd(isset($data['tags'])); // если не выбран ни один tag - false
		if (!isset($data['tags'])) $data['tags'] = []; // РАБОТАЕТ!
		$tags = $data['tags']; // массив $tags в отдельную переменную
		unset($data['tags']); // удаляю из $data массив $tags
		//dd($data, $tags);

		$post = Post::create($data); // мы получим новый пост, а из него id

		$post->tags()->attach($tags); // tags()-продолжаем запрос в базу в Post@tags(), а tags без () - массив из метода Post@tags() (return)

		

		return redirect()->route('post.index');

	}
}