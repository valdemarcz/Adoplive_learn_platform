<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
	<div class="container">
		<a  href="/allcourses">
			{{ config('app.name', 'AES')}}
		</a>
		<button class="navbar-toggler" type="button" data_toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>	
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">	@if(Auth::check())
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="/profile">Home <span class="sr-only">(current)</span></a>
				</li>
				<li>
					<a class="nav-link" href="/allcourses">All Courses</a>
				</li>
				<li>
					<a class="nav-link" href="/subscribtions">My Subscriptions</a>
				</li>
				<li>
					<a class="nav-link" href="/marks">My marks</a>
				</li>
				
			</ul>
			@else
				<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="/allcourses">Home <span class="sr-only">(current)</span></a>
				</li>
			</ul>
			@endif
			<ul class="navbar-nav ml-auto">
				@guest
					<li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
					<li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
				@else
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>
						
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							@can('Show Questions')
							<a class="dropdown-item" href="/questions"> Questionnaire</a>
							@endcan
							@can('Show Roles')
							<a class="dropdown-item" href="/roles"> Roles</a>
							@endcan
							@can('Show Permissions')
							<a class="dropdown-item" href="/permissions"> Permissions</a>
							@endcan
							@can('Show Users')
							<a class="dropdown-item" href="/users"> Users</a>
							@endcan
							@can('Show Courses')
							<a class="dropdown-item" href="/courses"> Courses</a>
							@endcan
							@can('Show Lessons')
							<a class="dropdown-item" href="/lessons"> Lessons</a>
							@endcan
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();"> {{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				@endguest	
			</ul>
		</div>
	</div>
	
</nav>