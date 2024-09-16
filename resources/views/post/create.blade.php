@extends('layouts.app')

@section('aside') {{-- Эта секция нужно для вставки блока со страницы! --}}
@parent {{-- Управляем расположением блока именно @parent, а не @show (т.к. на разных стр. расположение можеть быть разное) --}}
<p>Добавление со страницы posts</p> {{-- этого блока --}}
@endsection

@section('content')
<div>
	<form action="{{ route('post.store') }}" method="post">
		@csrf <!--без @csrf при любом роуте, кроме GET - ошибка (типа '419 PAGE EXPIRED'), а у нас POST-->
		<div class="mb-3">
			<label for="title" class="form-label">Title</label>
			<input name="title" type="text" class="form-control" id="title" placeholder="Title">
		</div>
		<div class="mb-3">
			<label for="content" class="form-label">Content</label>
			<textarea name="content"  class="form-control" id="content" placeholder="Content"></textarea>
		</div>
		<div class="mb-3">
			<label for="image" class="form-label">Image</label>
			<input name="image" type="text" class="form-control" id="image" placeholder="Image">
		</div>
		<div class="mb-3">
			<label for="likes" class="form-label">Likes</label>
			<input name="likes" type="number" class="form-control" id="likes" placeholder="Likes">
		</div>
		<!--type="submit" в форме должен быть обязательно-->
		<button type="submit" class="btn btn-primary">Create</button>
	</form>
</div>
@endsection