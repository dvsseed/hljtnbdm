<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title> @yield('title') </title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/css/completer.min.css">
    <link rel="stylesheet" href="/css/dm.css">
    @yield('css')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/dm/home">糖尿病共同照护</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
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
                <li><a href="http://www.hljtnb.com" target="__blank">黑龙江瑞京</a></li>
                <!-- li class="yield('aactive')"><a href="yield('navabout')">关于</a></li -->
                <!-- li><a href="{{-- url('/logout') --}}">退出</a></li -->
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
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container-fluid">
    @include('flash')
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12"> @yield('content') </div>
    </div>
</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-datepicker.min.js"></script>
<script src="/js/locales/bootstrap-datepicker.zh-TW.js" charset="UTF-8"></script>
<script src="/js/jquery.tablesorter.min.js"></script>
<script src="/js/validator.min.js"></script>
<!-- script src="/js/angular.min.js"></script -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
<script src="/js/completer.min.js"></script>
<script src="/js/dm.js"></script>
@yield('scripts')
</body>
</html>
