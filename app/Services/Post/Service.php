<?php

namespace App\Services\Post;

use App\Models\Post;

class Service
{
	public function store($data)
	{
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

		return $post; // добавили
	}



	public function update($post, $data)
	{
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
		//$post = $post->fresh(); // ДОБАВИЛ: принудительное обновление
		return $post->fresh(); // можно так
	}
}
