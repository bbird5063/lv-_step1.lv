<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Models\Category; // добавили
use App\Models\Tag; // добавили
use Illuminate\Support\Facades\DB;

class Service
{
	public function store($data)
	{
		try{
			DB::beginTransaction();
			
			$tags = $data['tags'];
			$category = $data['category'];
			unset($data['tags'], $data['category']);
	
			$tagIds = $this->getTagIgs($tags);
			$data['category_id'] = $this->getCategoryId($category);
	
			$post = Post::create($data);
	
			$post->tags()->attach($tagIds);

			DB::commit();

		}catch(\Exception $exception){
			DB::rollBack();
			//dd($exception->getMessage());
			return $exception->getMessage();
		}

		return $post;
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


	private function getCategoryId($item)
	{
		$category = !isset($item['id']) ? Category::create($item) : Category::find($item['id']);
		return $category->id;
	}

	private function getTagIgs($tags)
	{
		foreach ($tags as $tag) {
			//dd($tag); // проверка: array:2 ["id" => 20, "title" => "some new update title"]

			$tagIds = []; // массив новых id

			if (!isset($tag['id'])) // новый tag
			{
				$tag = !isset($tag['id']) ? Tag::create($tag) : Tag::find($tag['id']); // если тега нет - создай его, если есть - верни на его
				$tagIds[] = $tag->id; // добавление нового тега
			}
		}
		return $tagIds;
	}
}
