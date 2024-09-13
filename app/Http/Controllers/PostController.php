<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // добавили

class PostController extends Controller
{
	public function index()
	{
		//$posts = Post::all();
		$posts = Post::where('is_published', 1)->get(); // не забывать '->get()'(будет коллекция)
		//$posts = Post::withTrashed()->where('is_published', 1)->get(); // удаленные тоже показывает
		foreach ($posts as $post) {
			dump($post->title);
		}
		dd('END');
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
}
