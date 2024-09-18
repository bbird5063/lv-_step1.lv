@extends('layouts.app')

@section('aside') {{-- Эта секция нужно для вставки блока со страницы! --}}
@parent {{-- Управляем расположением блока именно @parent, а не @show (т.к. на разных стр. расположение можеть быть разное) --}}
<p>Добавление со страницы posts</p> {{-- этого блока --}}
@endsection

@section('content')
<a href="{{ route('post.create') }}" type="button" class="btn btn-primary mb-3">Add Post</a>
<!--'mb-3' - margin button 3 уровня-->

<!--<table class="table"> обычная-->
<table class="table table-dark table-striped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Title</th>
			<th scope="col">Content</th>
			<th scope="col">Likes</th>
			<th scope="col">Category_ID</th>
		</tr>
	</thead>
	<tbody>
		@foreach($posts as $post)
		<tr>
			<!--Второй аргумент 'route()' и есть '{post}' в 'routes\web.php'-->
			<td><a href="{{ route('post.show', $post->id) }}">{{ $post->id }}</a></td>
			<td><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></td>
			<td>{{ $post->content }}</td>
			<td>{{ $post->likes }}</td>
			<td>{{ $post->category_id }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection