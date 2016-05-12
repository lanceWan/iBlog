<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Ark - Responsive Multi-Purpose Theme</title>
<meta name="keywords" content="HTML5 Theme" />
<meta name="description" content="Ark - Responsive Multi-Purpose Template">
<meta name="author" content="prothemes.net">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="{{asset('front/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('front/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('front/css/animate.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('front/css/global.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('front/css/purple.css')}}" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="favicon.ico"/>
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
                    <div class="blog-sidebar margin-b-30">
                        <div class="blog-sidebar-heading">
                            <i class="blog-sidebar-heading-icon icon-tools"></i>
                            <h4 class="blog-sidebar-heading-title">Post Timeline</h4>
                        </div>
                        <div class="blog-sidebar-content blog-sidebar-content-height scrollbar">
                            <ul class="timeline-v2">
                                <li class="timeline-v2-list-item">
                                    <i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>
                                    <small class="timeline-v2-news-date">10 Aug, 2016</small>
                                    <h5 class="timeline-v2-news-title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h5>
                                </li>
                                <li class="timeline-v2-list-item">
                                    <i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>
                                    <small class="timeline-v2-news-date">10 Aug, 2016</small>
                                    <h5 class="timeline-v2-news-title"><a href="#">Nunc efficitur auctor felis, et tempus libero commodo non.</a></h5>
                                </li>
                                <li class="timeline-v2-list-item">
                                    <i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>
                                    <small class="timeline-v2-news-date">10 Aug, 2016</small>
                                    <h5 class="timeline-v2-news-title"><a href="#">Phasellus neque eros, finibus quis velit in, fringilla gravida est.</a></h5>
                                </li>
                                <li class="timeline-v2-list-item">
                                    <i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>
                                    <small class="timeline-v2-news-date">10 Aug, 2016</small>
                                    <h5 class="timeline-v2-news-title"><a href="#">Nunc efficitur auctor felis, et tempus libero commodo non.</a></h5>
                                </li>
                                <li class="timeline-v2-list-item">
                                    <i class="timeline-v2-badge-icon radius-circle fa fa-comments-o"></i>
                                    <small class="timeline-v2-news-date">10 Aug, 2016</small>
                                    <h5 class="timeline-v2-news-title"><a href="#">Phasellus neque eros, finibus quis velit in, fringilla gravida est.</a></h5>
                                </li>
                                <li class="clearfix" style="float: none;"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="blog-sidebar">
                        <div class="blog-sidebar-heading">
                            <i class="blog-sidebar-heading-icon icon-paperclip"></i>
                            <h4 class="blog-sidebar-heading-title">Tags</h4>
                        </div>
                        <div class="blog-sidebar-content">
                            <ul class="list-inline blog-sidebar-tags">
                                <li><a class="radius-50" href="#">envato</a></li>
                                <li><a class="radius-50" href="#">featured</a></li>
                                <li><a class="radius-50" href="#">material</a></li>
                                <li><a class="radius-50" href="#">fashion</a></li>
                                <li><a class="radius-50" href="#">themeforest</a></li>
                                <li><a class="radius-50" href="#">css3</a></li>
                                <li><a class="radius-50" href="#">photoshop</a></li>
                                <li><a class="radius-50" href="#">wordpress</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row margin-b-50">
                <div class="col-sm-6 sm-margin-b-30">
                    <div class="footer-address">
                        <h3 class="footer-title">Headquarter</h3>
                        <p class="footer-address-text">795 Folsom Ave, Suite 600, San Francisco, CA 94107</p>
                        <p class="footer-address-text">+123 456 7890</p>
                        <a class="footer-address-link" href="#">prothemes.net@gmail.com</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="footer-testimonials">
                        <div class="footer-testimonials-quote">
                            <p>世上本没有对错，看问题的角度不同，答案不同而已，我们应该学会常常用别人的角度看世界，多一分宽容，多一分理解，多一分求同存异。</p>
                        </div>
                        <span class="footer-testimonials-author">&#8212; 不要总以为自己是对的</span>
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
</body>
</html>