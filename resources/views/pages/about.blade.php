@extends('master')

@section('title')
	关于我们
@stop

@section('content')
    <link href="/css/business-casual.css" rel="stylesheet">

    <div class="brand">关于我们</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <!-- a class="navbar-brand" href="/">Business Casual</a -->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" -->
                <!-- ul class="nav navbar-nav" -->
                    <!-- li -->
                        <!-- a href="/admin">Home</a -->
                    <!-- /li -->
                    <!-- li -->
                        <!-- a href="/about">About</a -->
                    <!-- /li -->
                    <!-- li -->
                        <!-- a href="/contact">Contact</a -->
                    <!-- /li -->
                <!-- /ul -->
            <!-- /div -->
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Container -->
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">关于
                         <strong>糖尿病共同照护</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-6">
                    <img class="img-responsive img-border-left" src="/img/slide-2.jpg" alt="">
                </div>
                <div class="col-md-6">
                    <p>何谓共同照护（shared care)？定义可由许多层面来看，近来最常被采行的是Hickman (1994) 提出的「由医院专业人员与一般科医师联合参与，齐为慢性病人提供共同规划的照护服务内容及方式，除了出/入院、转诊资料外，增强资讯联结，使更多的资讯互通共享，形成有计划性的照护体系。」("The joint participation of hospital consultants and general practitioners in the planned delivery of care for patients with a chronic condition, informed by an enhanced information exchange over and above routine discharge and referral notes."）。</p>
                    <p>由此定义可以看到，慢性病以糖尿病为例，是强调多元化的专业人力的组合，此合作团队为共同照护的基本要素，除为了传递传统的出院摘要与转诊的资料以外，更要联结病人其它相关资讯，使团队的照护更具有效率及品质。</p>
                    <p>但另有人提出这定义过于强调提供者的角色，忽略了主角是一病人，他(她)们也要负起相当的自我照护责任。可见慢性病的照护，不单是由共同照护网的建立，尚需要其它的条件的配合，齐一脚步才能达到预期的目标。</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">专家
                        <strong>团队</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
                    <h3>刘国信
                        <small>主任医师</small>
                    </h3>
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
                    <h3>戴志行
                        <small>主任医师</small>
                    </h3>
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
                    <h3>刘雨田
                        <small>主任医师</small>
                    </h3>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; 黑龙江瑞京 2015</p>
                </div>
            </div>
        </div>
    </footer>

@stop
