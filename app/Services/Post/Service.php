<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Models\Category; // добавили
use App\Models\Tag; // добавили
use Illuminate\Support\Facades\DB; // добавили

class Service
{
	public function store($data)
	{
		try {
			DB::beginTransaction();

			$tags = $data['tags'];
			$category = $data['category'];
			unset($data['tags'], $data['category']);

			$tagIds = $this->getTagIgs($tags);
			$data['category_id'] = $this->getCategoryId($category);

			$post = Post::create($data);

			$post->tags()->attach($tagIds);

			DB::commit();
		} catch (\Exception $exception) {
			DB::rollBack();
			//dd($exception->getMessage());
			return $exception->getMessage();
		}

		return $post;
	}



	public function update($post, $data)
	{
		try {
			DB::beginTransaction();

			$tags = $data['tags'];
			$category = $data['category'];
			unset($data['tags'], $data['category']);

			$tagIds = $this->getTagIgsWithUpdate($tags);
			$data['category_id'] = $this->getCategoryIdWithUpdate($category);
			$post->update($data);
			/**
			 * ->attach($tags) не подойдет, т.к. ->attach($tags) добавляет(он добавит еще)
			 * Есть др.метод sync() - он старые привязки удаляет и прибавляет новые
			 * 
			 */
			$post->tags()->sync($tagIds);
			DB::commit(); // LVC: забыли, но в Postman ответ(JSON приходил!!!)
		} catch (\Exception $exception) {
			DB::rollBack();
			//dd($exception->getMessage());
			return $exception->getMessage();
		}
		return $post->fresh();
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

	private function getCategoryIdWithUpdate($item)
	{
		$category = !isset($item['id']) ? Category::create($item) : Category::find($item['id']);

		if (!isset($item['id'])) {
			$category = Category::create($item);
		} else {
			$category = Category::find($item['id']);
			$category->update($item);
			$category = $category->fresh();
		}

		return $category->id;
	}

	private function getTagIgsWithUpdate($tags)
	{
		$tagIds = [];
		foreach ($tags as $tag) {
			if (!isset($tag['id'])) {
				$tag = Tag::create($tag);
			} else {
				$currentTag = Tag::find($tag['id']);
				$currentTag->update($tag); // была проблемма решил: Models\Tag.php: protected $guarded = ['tag_id']
				$tag = $currentTag->fresh();
			}
			$tagIds[] = $tag->id;
		}

		//dd($tagIds); // array:2 [0 => 20, 1 => 57]. В БД тоже все добавилось.
		return $tagIds;
	}
}
