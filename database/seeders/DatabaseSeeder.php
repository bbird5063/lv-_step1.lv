<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post; // добавили
use App\Models\Category; // добавили
use App\Models\Tag; // добавили
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		//$posts = Post::factory(10)->make(); // 10-количество объектов. make(), а не create() (нам сейчас не нужно добавлять в БД)
		//$posts = Post::factory()->create(); // 10-количество объектов. make(), а не create() (нам сейчас не нужно добавлять в БД)
		//Post::factory(10)->make(); // в БД не добавляет
		//Post::factory()->create(); // в БД добавляет
		//Post::factory()->make(); // в БД не добавляет
		//dd($posts);

		$posts = Category::factory(20)->create(); // в БД добавляет 20 категорий
		$tags = Tag::factory(50)->create(); // в БД добавляет 50 тэгов
		$posts = Post::factory(200)->create(); // в БД добавляет 200 постов
		foreach ($posts as $post) {
			$tagIds = $tags->random(5)->pluck('id'); // 5 айдишников
			$post->tags()->attach($tagIds);
		}
	}
}
