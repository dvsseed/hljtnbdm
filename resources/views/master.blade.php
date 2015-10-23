<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="_token" content="{!! csrf_token() !!}"/>
	<title> @yield('title') </title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/all.css') }}">
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				@if(Auth::guest())
					<a class="navbar-brand" href="/">糖尿病共同照护</a>
				@else
					@if (Auth::user()->is_admin)
						<a class="navbar-brand" href="/admin">糖尿病共同照护</a>
					@else
						<a class="navbar-brand" href="/">糖尿病共同照护</a>
					@endif
				@endif

			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="http://www.hljtnb.com" target="__blank">黑龙江瑞京</a></li>
			</ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/logout') }}">退出</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		@include('flash')
	</div>

	@yield('content')

<!-- script -->
<script type="text/javascript" src="/js/all.js"></script>
</body>
</html>
