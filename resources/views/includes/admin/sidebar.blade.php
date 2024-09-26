<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		<li class="nav-header">ADMIN PANEL</li>
		<li class="nav-item">
			<a href="pages/calendar.html" class="nav-link">
				<!--<i class="nav-icon far fa-calendar-alt"></i> начальная-->
				<!--<i class="nav-icon fas fa-align-justify"></i> работает-->
				<!--<i class="fa-solid fa-list"></i> взял на сайте FA-->
				<i class="nav-icon fas fa-solid fa-list"></i>
				<p>
					Posts
					<span class="badge badge-info right">
						<!--{{ $posts->count() }} будет 10, т.к. paginate(10) -->
						{{ $posts->total() }}
					</span>
				</p>
			</a>
		</li>
	</ul>
</nav>