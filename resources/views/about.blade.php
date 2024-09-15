@extends('layouts.app')

@section('aside') {{-- Эта секция нужно для вставки блока со страницы! --}}
@parent {{-- Управляем расположением блока именно @parent, а не @show (т.к. на разных стр. расположение можеть быть разное) --}}
<p>Добавление со страницы about</p> {{-- этого блока --}}
@endsection

@section('content')
	<div>
		this is about page...
	</div>
@endsection