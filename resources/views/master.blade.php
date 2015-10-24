<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> @yield('title') </title>
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<!-- Custom CSS -->
        <link rel="stylesheet" href="/css/completer.min.css">
        <link rel="stylesheet" href="/css/main.css">
	<!-- Fonts -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
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
						<a class="navbar-brand" href="/about">关于</a>
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
							<a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
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

<!-- script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script -->
<!-- script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.tablesorter.min.js"></script>
<script src="/js/completer.min.js"></script>
<script src="/js/main.js"></script>
<script> @yield('scripts') </script>
</body>

</html>
