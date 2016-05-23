@extends('layouts.index')
@section('title')
<title>{{$article->title}} - i晚黎博客</title>
@endsection
@section('css')
<link href="{{asset('front/plugins/highlight/styles/monokai-sublime.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('promo')
<section class="breadcrumbs-v5 bg-position-fixed breadcrumbs-v5-bg-img-v4">
    <div class="container">
        <h2 class="breadcrumbs-v5-title">I am Wanli</h2>
        <span class="breadcrumbs-v5-subtitle">I am a slow walker, but I never walk backwards...</span>
    </div>
</section>
<section class="breadcrumbs-v1">
    <div class="container">
        <h2 class="breadcrumbs-v1-title">Article</h2>
        <ol class="breadcrumbs-v1-links">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="{{url('cate/'.$article->category_id)}}"><i class="fa fa-navicon"></i> {{$category}}</a></li>
            <li class="active">{{$article->title}}</li>
        </ol>
    </div>
</section>
@endsection
@section('content')
<article class="blog-grid margin-b-30">
    <!-- Blog Grid Content -->
    <div class="blog-grid-content">
        <h2 class="blog-grid-title-lg">{{$article->title}}</h2>

        @if($article->img)
        <img class="img-responsive margin-b-20" src="{{$article->img}}" alt="">
        @endif
        {!!$article->content_html!!}
        
    </div>
    <!-- End Blog Grid Content -->
    <div class="divider-v1"><div class="divider-v1-element"><i class="divider-v1-icon fa fa-skyatlas"></i></div></div>

    <!-- Blog Comment -->
    <div class="bg-color-white margin-b-30">
        <div class="blog-single-post-content">
            <!-- Heading v1 -->
            <div class="heading-v1 text-center margin-b-50">
                <h2 class="heading-v1-title">Leave a comment</h2>
            </div>
            <!-- End Heading v1 -->

            <!-- Single Post Comment Form -->
            <div class="blog-single-post-comment-form">
                <div class="ds-thread" data-thread-key="{{$article->id}}" data-title="{{$article->title}}" data-url="{{url('article/'.$article->id)}}"></div>
            <script type="text/javascript">
            var duoshuoQuery = {short_name:"ibanya"};
                (function() {
                    var ds = document.createElement('script');
                    ds.type = 'text/javascript';ds.async = true;
                    ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                    ds.charset = 'UTF-8';
                    (document.getElementsByTagName('head')[0] 
                     || document.getElementsByTagName('body')[0]).appendChild(ds);
                })();
                </script>
            </div>
        </div>
    </div>
</article>
@endsection
@section('rightSide')
<div class="blog-sidebar margin-b-30">
    <div class="blog-sidebar-content scrollbar">
        <h3 class="portfolio-item-subitem-title">Published</h3>
        <p class="portfolio-item-subitem-paragraph">{{$article->created_at}}</p>
        <hr>
        <h3 class="portfolio-item-subitem-title">Categories</h3>
        <a class="portfolio-item-category" href="{{url('cate/'.$article->id)}}">{{$category}}</a>
        <hr>
        <h3 class="portfolio-item-subitem-title">Tags</h3>
        <ul class="list-unstyled tags-v2 margin-b-20">
            @if($article->tag)
            @foreach($article->tag as $v)
            <li><a href="{{url('tag/'.$v->id)}}">{{$v->name}}</a></li>
            @endforeach
            @endif
        </ul>
        <hr>
        <h3 class="portfolio-item-subitem-title">Share</h3>
        <ul class="list-inline">
            <li class="theme-icons-wrap"><a href="#"><i class="theme-icons theme-icons-base-hover theme-icons-xs radius-circle fa fa-facebook"></i></a></li>
            <li class="theme-icons-wrap"><a href="#"><i class="theme-icons theme-icons-base-hover theme-icons-xs radius-circle fa fa-twitter"></i></a></li>
            <li class="theme-icons-wrap"><a href="#"><i class="theme-icons theme-icons-base-hover theme-icons-xs radius-circle fa fa-pinterest-p"></i></a></li>
            <li class="theme-icons-wrap"><a href="#"><i class="theme-icons theme-icons-base-hover theme-icons-xs radius-circle fa fa-dribbble"></i></a></li>
            <li class="theme-icons-wrap"><a href="#"><i class="theme-icons theme-icons-base-hover theme-icons-xs radius-circle fa fa-instagram"></i></a></li>
        </ul>
    </div>
</div>
@parent
@endsection
@section('js')
<script type="text/javascript" src="{{asset('front/plugins/highlight/highlight.pack.js')}}"></script>
<script>
    hljs.initHighlighting();
</script>
@endsection