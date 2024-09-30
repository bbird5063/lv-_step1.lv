<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('build/assets/app-D-sv12UV.css') }}">
	<title>Document</title>
</head>

<body>
	<div class="container">
		<div class="row">

			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<div class="navbar-nav">
							<a class="nav-link active" href="{{ route('main.index') }}">Main</a>
							<a class="nav-link" href="{{ route('post.index') }}">Posts</a>
							<a class="nav-link" href="{{ route('about.index') }}">About</a>
							<a class="nav-link" href="{{ route('contact.index') }}">Contacts</a>
							@can('view', auth()->user())
								<a class="nav-link" href="{{ route('admin.post.index') }}">Admin</a>
							@endcan
						</div>
					</div>
				</div>
			</nav>

		</div>
		@include('inc.aside') {{-- Pасположение 'inc.aside' устанавливаем в этом файле --}}
		@yield('content')
	</div>
</body>

</html>