@extends('layouts.index')
@section('promo')
<section class="breadcrumbs-v5 bg-position-fixed breadcrumbs-v5-bg-img-v4">
    <div class="container">
        <h2 class="breadcrumbs-v5-title">I am Wanli</h2>
        <span class="breadcrumbs-v5-subtitle">I am a slow walker, but I never walk backwards...</span>
    </div>
</section>
<section class="breadcrumbs-v1">
    <div class="container">
        <h2 class="breadcrumbs-v1-title">Shortcodes</h2>
        <ol class="breadcrumbs-v1-links">
            <li><a href="#">Shortcodes</a></li>
            <li><a href="#">Typography/Misc.</a></li>
            <li class="active">Breadcrumbs</li>
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

    @if($article->tag)
    <ul class="list-inline blog-sidebar-tags">
    @foreach($article->tag as $v)
        <li><a class="radius-50" href="#">{{$v->name}}</a></li>
    @endforeach
    </ul>
    @endif

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