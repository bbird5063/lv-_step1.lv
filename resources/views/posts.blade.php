@extends('layouts.app')

@section('aside') {{-- Эта секция нужно для вставки блока со страницы! --}}
@parent {{-- Управляем расположением блока именно @parent, а не @show (т.к. на разных стр. расположение можеть быть разное) --}}
<p>Добавление со страницы posts</p> {{-- этого блока --}}
@endsection

@section('content')
<!--<table class="table"> обычная-->
<table class="table table-dark table-striped">
	<thead>
		<tr>
			<th scope="col">Title</th>
			<th scope="col">Content</th>
			<th scope="col">Likes</th>
		</tr>
	</thead>
	<tbody>
		@foreach($posts as $post)
		<tr>
			<td>{{ $post->title }}</td>
			<td>{{ $post->content }}</td>
			<td>{{ $post->likes }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection