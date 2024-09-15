@extends('layouts.app')

@section('aside') {{-- Эта секция нужно для вставки блока со страницы! --}}
@parent {{-- Управляем расположением блока именно @parent, а не @show (т.к. на разных стр. расположение можеть быть разное) --}}
<p>Добавление со страницы posts</p> {{-- этого блока --}}
@endsection

@section('content')
	@foreach($posts as $post)
		<div>{{ $post->title }}</div>
		<div>{{ $post->content }}</div>
		<div>{{ $post->likes }}</div>
	@endforeach
@endsection