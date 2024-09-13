<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // добавили

class PostController extends Controller
{
	public function index() {
		//$posts = Post::all();
		$posts = Post::where('is_published', 1)->get(); // не забывать '->get()'(будет коллекция)
		foreach($posts as $post){
			dump($post->title);
		}
		dd($posts);
	}
}