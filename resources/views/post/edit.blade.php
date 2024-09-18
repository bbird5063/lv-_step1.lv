@extends('layouts.app')

@section('aside') {{-- Эта секция нужно для вставки блока со страницы! --}}
@parent {{-- Управляем расположением блока именно @parent, а не @show (т.к. на разных стр. расположение можеть быть разное) --}}
<p>Добавление со страницы posts</p> {{-- этого блока --}}
@endsection

@section('content')
<div>
	<form action="{{ route('post.update', $post->id) }}" method="post">
		@csrf <!--без @csrf при любом роуте, кроме GET - ошибка (типа '419 PAGE EXPIRED'), а у нас POST-->
		@method('patch') <!--добавление(PUT)/обновления(PATCH)-->
		<div class="mb-3">
			<label for="title" class="form-label">Title</label>
			<input name="title" type="text" class="form-control" id="title" placeholder="Title" value="{{ $post->title }}">
		</div>
		<div class="mb-3">
			<label for="content" class="form-label">Content</label>
			<textarea name="content"  class="form-control" id="content" placeholder="Content">{{ $post->content }}</textarea>
		</div>
		<div class="mb-3">
			<label for="image" class="form-label">Image</label>
			<input name="image" type="text" class="form-control" id="image" placeholder="Image" value="{{ $post->image }}">
		</div>
		<div class="mb-3">
			<label for="likes" class="form-label">Likes</label>
			<input name="likes" type="number" class="form-control" id="likes" placeholder="Likes" value="{{ $post->likes }}">
		</div>

		<label for="category" class="form-label">Category</label>
		<select class="form-select" aria-label="Default select example" name="category_id" id="category">
			@foreach($categories as $categ) <!-- здесь '$' надо, т.к. здесь переменная, а не строка(как в compact('categories'))-->
			<option {{ $categ->id == $post->category->id ? ' selected' : '' }} value="{{ $categ->id}}">{{ $categ->title }}</option> 
			<!--
				Mожно и '== $post->category->id'(?), и '== $post->category_id'(это понятно).
				Специально изменил '$categories as $category' на '$categories as $categ',
				все равно работает. Что такое '$post->category->id'?
				НАШЕЛ!
				В модель Post.php мы добавили метод 'category()', который и отдает всю запись `categories`, которая соответствует 'category_id' таблицы `posts`.
				И в этот файл приходит $post(класс Post-модель) с методом 'category()'!
			-->
			@endforeach
		</select>

		<!--type="submit" в форме должен быть обязательно-->
		<!--В bootstrap-5 отступы не mb-, а mt- (https://getbootstrap.su/docs/5.0/utilities/spacing/)-->
		<button type="submit" class="btn btn-primary">Update</button>
	</form>
</div>
@endsection