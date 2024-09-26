@extends('layouts.admin')

@section('content')
<div>
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
</div>

<div>
	<!--$posts уже другой объект ($posts = Post::paginate...), у есть метод links()-->
	<!--'->withQueryString->' - с учетом фильтра-->
	{{ $posts->withQueryString()->links() }}
</div>
@endsection