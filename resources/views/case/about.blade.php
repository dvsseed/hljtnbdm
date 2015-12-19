@extends('layout')

@section('title')
    关于方案管理
@stop

@section('aactive')
    active
@stop

@section('content')
    <section id="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="section-heading">关于</h2>

                    <h3 class="section-subheading text-muted">方案管理</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/1.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>作业说明</h4>
                                    <h4 class="subheading">初诊、复诊、年度检查</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">一般</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/2.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>操作说明</h4>
                                    <h4 class="subheading">输入
                                <div class="timeline-body">
                                    <p class="text-muted">取消</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/3.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>流程说明</h4>
                                    <h4 class="subheading">区分</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">三部分</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/4.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>文档格式</h4>
                                    <h4 class="subheading">格式</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">一、二、三</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>
                                    <br>
                                    <br></h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@stop
