<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // добавили
use App\Models\Category; // добавили
use Ramsey\Uuid\Type\Integer;

class PostController extends Controller
{
	public function index()
	{
		// 0. Рабочий код:
		//$posts = Post::all();
		//return view('post.posts', compact('posts')); // compact() - php-функция, '$' не надо

		// 1. Выберем все посты с собаками :
		//$catagory = Category::find(2);
		//$posts = Post::where('category_id', $catagory->id)->get();
		//dd($posts);

		// 2. По другому все посты с собаками (см. 'app\Models\Category.php'):
		//$catagory = Category::find(2);
		//dd($catagory->posts);

		// Определим категорию определенного поста (см. 'app\Models\Post.php'):
		$post = Post::find(3);
		dd($post->category); // выводит запись из 'catigories' соответствующей 'posts'(id=3)

	}

	public function create()
	{
		return view('post.create');
	}
	
	public function store() {
		$data = request()->validate([
			'title' => 'string',
			'content' => 'string',
			'image' => 'string',
			'likes' => 'integer',
		]);

		Post::create($data);
		return redirect()->route('post.index');
	}


	/*
	public function show($id) {
		//$post = Post::find($id);
		$post = Post::findOrFail($id); // findOrFail: если такой записи нет -> '404 NOT FOUND'
		Чтобы это все не писать, пишем в аргументах:
		'Post $post' ($post-название переменной как в роутере {post})
		и Laravel сделает все это за нас!
	*/
	public function show(Post $post) {
		return view('post.show', compact('post'));
	}

	public function edit(Post $post) {
		return view('post.edit', compact('post'));
	}

	public function update(Post $post)
	{
		$data = request()->validate([
			'title' => 'string',
			'content' => 'string',
			'image' => 'string',
			'likes' => 'integer',
		]);
		$post->update($data);
		return redirect()->route('post.show', $post->id);
	}

	public function destroy(Post $post){ // delete
		$post->delete();
		return redirect()->route('post.index');
	}


//===Остальные методы исользовались для изучения и для сайта не нужны===

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

	public function firstOrCreate()
	{
		$post = Post::find(1);
		$anotherPost = [
			'title' => 'Измененный 888 пост',
			'content' => 'Контент измененного 7 поста',
			'image' => 'image_7(изм.)',
			'likes' => 7000,
			'is_published' => 1,
		];

		$post = Post::firstOrCreate(
			[
				'title' => 'eeeeee', // 1 аргумент: контрольный массив(ключи). Если находит запись с таким 'title', то ее и возвращает. Если не находит, то создает. Он не обязательно должен быть равным элементу 2 массива, во 2 массиве его можеть и не быть
			],
			[ // или $anotherPost
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

	public function updateOrCreate()
	{
		$anotherPost = [
			'title' => 'updateOrCreate() пост',
			'content' => 'Контент updateOrCreate()',
			'image' => 'image_99',
			'likes' => 70,
			'is_published' => 1,
		];

		$post = Post::updateOrCreate([
			'title' => 'xxx',
		], [ // или $anotherPost
			'title' => 'Восьмой пост', // это значение может быть другим(чем в ключе выше)
			'content' => 'Контент восьмого поста',
			'image' => 'image_99',
			'likes' => 70,
			'is_published' => 1,
		]);

		dump($post->title);
		dd('updateOrCreate');
	}
}
