<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // добавили

class PostController extends Controller
{
	public function index()
	{
		$posts = Post::all();
		return view('posts', compact('posts')); // compact() - php-функция, '$' не надо
	}

	public function create()
	{
		$postArr = [
			[
				'title' => 'Восьмой пост',
				'content' => 'Контент восьмого поста',
				'image' => 'image_8',
				'likes' => 2,
				'is_published' => 1,
			],
			[
				'title' => 'Девятый пост',
				'content' => 'Контент девятого поста',
				'image' => 'image_9',
				'likes' => 9,
				'is_published' => 1,
			],
			[
				'title' => 'Десятый пост',
				'content' => 'Контент десятого поста',
				'image' => 'image_10',
				'likes' => 10,
				'is_published' => 1,
			],
		];
		/*
		Можно поэлементно:

		foreach($postArr as $item) {
			Post::create([
				'title' => $item['title'],
				'content' => $item['content'],
				'image' => $item['image'],
				'likes' => $item['likes'],
				'is_published' => $item['is_published'],
			]);
		}
		*/
		foreach ($postArr as $item) {
			Post::create($item);
		}

		dd('CREADED!');
	}

	public function update()
	{
		$post = Post::find(6);
		//dd($post->title); // проверка
		/* как и в create: */
		$post->update([
			'title' => 'Измененный шестой пост', // необязательно все
			'content' => 'Контент измененного 6 поста',
			'image' => 'image_6(изм.)',
			'likes' => 6,
			'is_published' => 1,
		]);
		dd('update!');
	}

	public function delete()
	{
		$post = Post::find(2);
		$post->delete();
		dd('deleted');
	}

	public function restore()
	{
		$post = Post::withTrashed()->find(2); // withTrashed() - искать и в мусорке
		$post->restore();
		dd('restore');
	}

	public function firstOrCreate(){
		$post = Post::find(1);
		$anotherPost = [
			'title' => 'Измененный 888 пост',
			'content' => 'Контент измененного 7 поста',
			'image' => 'image_7(изм.)',
			'likes' =>7000,
			'is_published' => 1,
		];

		$post = Post::firstOrCreate(
			[
				'title' => 'eeeeee', // 1 аргумент: контрольный массив(ключи). Если находит запись с таким 'title', то ее и возвращает. Если не находит, то создает. Он не обязательно должен быть равным элементу 2 массива, во 2 массиве его можеть и не быть
			],[ // или $anotherPost
				//'title' => 'qqqqq', // необязательно
				'content' => 'Контент измененного qqqqq поста',
				'image' => 'image_qqqqqq(изм.)',
				'likes' => 8000,
				'is_published' => 1,
			]
		);

		dump($post->content);
		dd('firstOrCreate() END');
	}

	public function updateOrCreate() {
		$anotherPost = [
			'title' => 'updateOrCreate() пост',
			'content' => 'Контент updateOrCreate()',
			'image' => 'image_99',
			'likes' =>70,
			'is_published' => 1,
		];

		$post = Post::updateOrCreate([
			'title' => 'xxx',
		],[ // или $anotherPost
			'title' => 'Восьмой пост', // это значение может быть другим(чем в ключе выше)
			'content' => 'Контент восьмого поста',
			'image' => 'image_99',
			'likes' =>70,
			'is_published' => 1,
		]);

		dump($post->title);
		dd('updateOrCreate');
	}
}
