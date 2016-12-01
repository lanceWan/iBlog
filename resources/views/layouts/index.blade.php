<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
@section('title')
<title>i晚黎 - i晚黎博客</title>
@show
<meta name="keywords" content="i晚黎,晚黎博客,Laravel,PHP,PHP框架,教程,资源,学习,笔记" />
<meta name="description" content="i晚黎博客致力于提供优质学习资源,分享个人笔记.">
<meta name="author" content="iwanli.me">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="{{asset('front/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('front/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('front/css/animate.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('front/css/global.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('front/css/purple.css')}}" rel="stylesheet" type="text/css"/>
@yield('css')
<link rel="shortcut icon" href="{{asset('front/img/favicon.ico')}}"/>
</head>
<body>
<div class="wrapper animsition">
    @include('layouts.menu')

    @yield('promo')

    <div class="bg-color-sky-light">
        <div class="content-md container">
            <div class="row">
                <div class="col-md-9 md-margin-b-30">
                    @yield('content')
                </div>
                <div class="col-md-3">
                    @section('rightSide')
                    <div class="blog-sidebar margin-b-30">
                        <div class="blog-sidebar-heading">
                            <i class="blog-sidebar-heading-icon fa fa-paperclip"></i>
                            <h4 class="blog-sidebar-heading-title">视频专题</h4>
                        </div>
                        <div class="blog-sidebar-content">
                            <ul class="list-unstyled lists-base">
                                <li><i class="lists-item-element fa fa-angle-right"></i> <a target="_black" href="url('article/25')">Laravel5.2 Entrust视频</a></li>
                                <li><i class="lists-item-element fa fa-angle-right"></i> <a target="_black" href="url('article/65')">Laravel5.3&Vue2.0系列</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="blog-sidebar margin-b-30">
                        <div class="blog-sidebar-heading">
                            <i class="blog-sidebar-heading-icon fa fa-fire"></i>
                            <h4 class="blog-sidebar-heading-title">{{trans('labels.home.hot')}}</h4>
                        </div>
                        <div class="blog-sidebar-content scrollbar">
                            <ul class="timeline-v2">
                                @if($hotArticles)
                                @foreach($hotArticles as $v)
                                <li class="timeline-v2-list-item">
                                    <i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>
                                    <small class="timeline-v2-news-date">{{$v['created_at']}}</small>
                                    <h5 class="timeline-v2-news-title"><a href="{{url('article/'.$v['id'])}}">{{$v['title']}}</a></h5>
                                </li>
                                @endforeach
                                @else
                                <li class="timeline-v2-list-item">
                                    <i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>
                                    <small class="timeline-v2-news-date">iwanli</small>
                                    <h5 class="timeline-v2-news-title">{{trans('labels.hot')}}</h5>
                                </li>
                                @endif
                                <li class="clearfix" style="float: none;"></li>
                            </ul>
                        </div>
                    </div>

                    <div class="blog-sidebar margin-b-30">
                        <div class="blog-sidebar-heading">
                            <i class="blog-sidebar-heading-icon fa fa-paperclip"></i>
                            <h4 class="blog-sidebar-heading-title">{{trans('labels.home.tag')}}</h4>
                        </div>
                        <div class="blog-sidebar-content">
                            <ul class="list-inline blog-sidebar-tags">
                                @if($tags)
                                @foreach($tags as $v)
                                <li><a class="radius-50" href="{{url('tag/'.$v->id)}}">{{$v->name}}</a></li>
                                @endforeach
                                @else
                                <li>{{trans('labels.tag')}}</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="blog-sidebar">
                        <div class="blog-sidebar-heading">
                            <i class="blog-sidebar-heading-icon fa fa-paperclip"></i>
                            <h4 class="blog-sidebar-heading-title">友情链接</h4>
                        </div>
                        <div class="blog-sidebar-content">
                            <ul class="list-unstyled lists-base">
                                <li><i class="lists-item-element fa fa-angle-right"></i> <a target="_black" href="https://phphub.org/">PHPHub(推荐)</a></li>
                                <li><i class="lists-item-element fa fa-angle-right"></i> <a target="_black" href="http://laravelacademy.org/">Laravel学院(推荐)</a></li>
                                <li><i class="lists-item-element fa fa-angle-right"></i> <a target="_black" href="http://aabvip.com/">明日复明日</a></li>
                            </ul>
                        </div>
                    </div>
                    @show
                </div>
            </div>
        </div>
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row margin-b-50">
                <div class="col-sm-6 sm-margin-b-30">
                    <div class="footer-address">
                        <h3 class="footer-title">About Me</h3>
                        <p class="footer-address-text">如果你有什么疑问或者交流，下面联系方式可以找到晚黎~.~</p>
                        <p class="footer-address-text">QQ:709344897</p>
                        <a class="footer-address-link" href="mailto:709344897@qq.com">709344897@qq.com</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="footer-testimonials">
                        <div class="footer-testimonials-quote">
                            <p>当你的才华还撑不起你的野心时，就应该静下心来学习,当你的能力还驾驭不了你的目标时，就应该沉下心来历练.</p>
                        </div>
                        <span class="footer-testimonials-author">&#8212; iWanli</span>
                    </div>
                </div>
            </div>

            <ul class="list-inline footer-copyright">
                <li class="footer-copyright-item">Copyright &#169; 2016 iWanli. All Rights Reserved.</li>
            </ul>
        </div>
    </footer>
</div>
<a href="javascript:void(0);" class="js-back-to-top back-to-top-theme"></a>
<!--[if lt IE 9]>
<script src="/front/plugins/html5shiv.js"></script>
<script src="/front/plugins/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="{{asset('front/plugins/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front/plugins/jquery.migrate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<script type="text/javascript" src="{{asset('front/plugins/jquery.back-to-top.js')}}"></script>
<script type="text/javascript" src="{{asset('front/plugins/jquery.smooth-scroll.js')}}"></script>
<script type="text/javascript" src="{{asset('front/plugins/jquery.animsition.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front/plugins/jquery.wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front/js/app.js')}}"></script>
@yield('js')
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?{{env('BAIDU_TONGJI')}}";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>
</html>