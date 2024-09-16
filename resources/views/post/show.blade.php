@extends('layouts.app')

@section('aside') {{-- Эта секция нужно для вставки блока со страницы! --}}
@parent {{-- Управляем расположением блока именно @parent, а не @show (т.к. на разных стр. расположение можеть быть разное) --}}
<p>Добавление со страницы posts</p> {{-- этого блока --}}
@endsection

@section('content')
<table class="table table-dark table-striped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Title</th>
			<th scope="col">Content</th>
			<th scope="col">Likes</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{ $post->id }}</td>
			<td>{{ $post->title }}</td>
			<td>{{ $post->content }}</td>
			<td>{{ $post->likes }}</td>
		</tr>
	</tbody>
</table>
<a href="{{ route('post.edit', $post->id) }}" type="button" class="btn btn-success mb-3">Edit</a>

<form action="{{ route('post.destroy', $post->id) }}" method="post">
	@csrf <!--без @csrf при любом методе, кроме GET - ошибка (в этом случае ничего не происходит), а у нас DELETE, поэтому пришлось сделать маленькую форму с @csrf. Это все для защиты-->
	@method('delete')
	<input type="submit" value="Delete" class="btn btn-danger mb-3">
</form>

<a href="{{ route('post.index') }}" type="button" class="btn btn-primary mb-3">All Posts</a>
<!--'mb-3' - margin button 3 уровня-->
@endsection