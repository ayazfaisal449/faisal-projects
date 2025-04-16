<div class="container">
	<header>
		<div class="row">
			<div class="large-3 small-3 columns">
				<a class="logo" href="{{Request::root()}}"><img alt="logo alqasba" src="{{Request::root()}}/img/logo.jpg" /></a>
			</div>
			<div class="large-7 small-7 columns">
				<nav>
					<ul>
						<li><a href="{{ Request::root()}}/admin/users">Users</a></li>
						<li><a href="{{ Request::root()}}/admin/group">Groups</a></li>
						<li><a href="{{ Request::root()}}/admin/permission">Permissions</a></li>
                        <li><a href="{{ Request::root()}}/admin/firm">Firms</a></li>
                        <li><a href="{{ Request::root()}}/admin/course">Courses</a></li>
					</ul>
				</nav>
			</div>
			<div class="large-2 small-2 columns">
				<a href="{{Request::root()}}/logout">Logout</a>
			</div>
		</div>
	</header>
</div>