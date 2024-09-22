<?php

namespace App\Http\Controllers\Post;

//use App\Http\Controllers\Controller;
//use App\Models\Post;
use App\Http\Requests\Post\StoreRequest;

class StoreController extends BaseController // изменили на BaseController
{
	public function __invoke(StoreRequest $request)
	{
		$data = $request->validated();

		$this->service->store($data); // идет работа с БД

		return redirect()->route('post.index');
	}
}
