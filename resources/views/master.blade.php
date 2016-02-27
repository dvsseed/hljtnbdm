<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title> @yield('title') </title>
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<!-- Custom CSS -->
        <link rel="stylesheet" href="/css/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" href="/css/completer.min.css">
        <link rel="stylesheet" href="/css/main.css">
        @yield('css')
	<!-- Fonts -->
	<!-- link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" -->
	<!-- link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" -->
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
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
					@else
						<a class="navbar-brand" href="/">糖尿病共同照护</a>
					@endif
				@endif
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<!-- li class="yield('aactive')"><a href="/about">关于</a></li -->
					@if(Auth::check() && Auth::user()->position != '患者' && !Auth::user()->is_admin)
						@if(Auth::user()->position == '住院医生' || Auth::user()->position == '门诊医生')
							<li class="@yield('activep')"><a href="/patient">患者资料</a></li>
							<li class="@yield('activef')"><a href="/patient/followup/{{ Auth::user()->id }}">随访清单</a></li>
							<li class="@yield('activec')"><a href="/case">方案</a></li>
							<li class="@yield('actived')"><a href="/discharge">出院指导</a></li>
						@else
							<li class="@yield('activep')"><a href="/patient">患者资料</a></li>
							<li class="@yield('activef')"><a href="/patient/followup/{{ Auth::user()->id }}">随访清单</a></li>
							<li class="@yield('activec')"><a href="/case">方案</a></li>
						@endif
						@if(Auth::user()->position == '院长' || Auth::user()->position == '副院长')
							<li class="@yield('activeq1')"><a href="/quality">照护品质</a></li>
							<li class="@yield('activeq2')"><a href="/executive">行政报表</a></li>
						@endif
					@endif
					<li><a href="http://www.hljtnb.com" target="__blank">黑龙江瑞京</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
					@else
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/logout') }}">退出</a></li>
								<li><a href="{{ url('/dm/personal') }}">个人信息</a></li>
 							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		@include('flash')
	</div>

	@yield('content')

<!-- script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script -->
<!-- script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-datepicker.min.js"></script>
<script src="/js/locales/bootstrap-datepicker.zh-TW.js" charset="UTF-8"></script>
<script src="/js/jquery.tablesorter.min.js"></script>
<script src="/js/validator.min.js"></script>
<script src="/js/completer.min.js"></script>
<script src="/js/main.js"></script>
<script> @yield('scripts') </script>
@yield('loadScripts')
</body>

</html>
