@extends('layouts.index')
@section('promo')
<div class="promo-block-v1 promo-block-v1-bg-img-v3 fullheight text-center">
    <div class="container vertical-center-aligned">
        <h1 class="promo-block-v1-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0">Welcome To iWanli's Blog</h1>
        <p class="promo-block-v1-text margin-b-40 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
            I am a slow walker, but I never walk backwards...
        </p>
    </div>
</div>
<!--========== PAGE CONTENT ==========-->
<div class="bg-color-sky-light">
    <div class="container-sm">
        <div class="bg-color-white border-1 padding-40 margin-t-o-80">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Heading v1 -->
                    <div class="heading-v1 margin-b-20 text-center">
                        <h2 class="heading-v1-title">Story About Me</h2>
                        <span class="heading-v1-subtitle">碎碎念念的话，伴随着成长</span>
                    </div>

                    <p>时间真的好快，嗖的一下就长成了今天这模样。永远不会像《挪威森林》村上写的那一句话：一直以为十八岁之后是十九岁，十九岁后是十八岁，如此反复。如今说好的十八岁离开好几年了，好宅不代表着我老，如果认真的去做的更好，只是个开始。如今过的日子并不好过的话，完全可以付出更多的努力再来活一次，找到真正想要的自己。</p>
                    <p>执着的去做，不怕舍不得睡觉、玩乐、安逸的时间去拼，要知道现在的痛苦和难受都是以前放弃了太多努力。所以现在要抓紧努力，哪怕需要你花全部精力。去拼，如果没有天分，就用时间去换，走得再慢也不要后退。希望再过几年真的被喊叔、阿姨的年纪，那时候回头感谢一下现在选择拼搏的我。</p>
                    <p>没有天分，就用时间去换......</p>
                </div>
            </div>
            <!--// end row -->
        </div>

        <!-- Counters v1 -->
        <div class="content-md">
            <div class="counters-v1">
                <div class="row">
                    <div class="col-sm-3 col-xs-6 xs-full-width counters-v1-border counters-v1-border-first">
                        <!-- Counters v1 Body -->
                        <div class="counters-v1-body wow fadeInUp" data-wow-duration=".5" data-wow-delay=".3s">
                            <span class="counters-v1-subtitle">Over</span>
                            <figure class="counter counters-v1-number">30</figure>
                            <br/>
                            <h4 class="counters-v1-title">Features</h4>
                        </div>
                        <!-- End Counters v1 Body -->
                    </div>
                    <div class="col-sm-3 col-xs-6 xs-full-width counters-v1-border counters-v1-border-second">
                        <!-- Counters v1 Body -->
                        <div class="counters-v1-body wow fadeInDown" data-wow-duration=".5" data-wow-delay=".3s">
                            <span class="counters-v1-subtitle">Over</span>
                            <figure class="counter counters-v1-number">150</figure>
                            <br/>
                            <h4 class="counters-v1-title">Theme Pages</h4>
                        </div>
                        <!-- End Counters v1 Body -->
                    </div>
                    <div class="col-sm-3 col-xs-6 xs-full-width counters-v1-border counters-v1-border-third">
                        <!-- Counters v1 Body -->
                        <div class="counters-v1-body wow fadeInUp" data-wow-duration=".5" data-wow-delay=".3s">
                            <span class="counters-v1-subtitle">Over</span>
                            <figure class="counter counters-v1-number">10</figure>
                            <br/>
                            <h4 class="counters-v1-title">Colors</h4>
                        </div>
                        <!-- End Counters v1 Body -->
                    </div>
                    <div class="col-sm-3 col-xs-6 xs-full-width counters-v1-border counters-v1-border-third">
                        <!-- Counters v1 Body -->
                        <div class="counters-v1-body wow fadeInDown" data-wow-duration=".5" data-wow-delay=".3s">
                            <span class="counters-v1-subtitle">Over</span>
                            <figure class="counter counters-v1-number">5</figure>
                            <br/>
                            <h4 class="counters-v1-title">Header Options</h4>
                        </div>
                        <!-- End Counters v1 Body -->
                    </div>
                </div>
                <!-- // end row -->
            </div>
        </div>
        <!-- End Counters v1 -->
    </div>
</div>

<div class="content-md container" id="pageScroll">
    <div class="heading-v3 text-center">
        <h2 class="heading-v3-title">Great Diary</h2>
        <div class="divider-v3"><div class="divider-v3-element"><i class="divider-v3-icon fa fa-skyatlas"></i></div></div>
        <p class="heading-v3-text">It's the small details that will make a big difference</p>
    </div>
</div>
@endsection
@section('content')
<!-- Masonry Grid -->
<div class="masonry-grid">
    @if($articles)
    @foreach($articles as $v)
    <div class="masonry-grid-item col-1">
        <!-- Blog Grid -->
        <article class="blog-grid">
            <div class="blog-grid-box-shadow">
                <div class="blog-grid-content">
                    <h2 class="blog-grid-title-md"><a href="{{url('article/'.$v->id)}}">{{$v->title}}</a></h2>
                    @if($v->img)
                        <div class="starImg">
                            <a href="{{url('article/'.$v->id)}}"><img class="img-responsive margin-b-10" src="{{$v->img}}" alt="{{$v->title}}"></a>
                        </div>
                    @endif
                    <p>{!!$v->intro!!}</p>
                </div>
                <div class="blog-grid-supplemental">
                    <span class="blog-grid-supplemental-title">
                        <a class="blog-grid-supplemental-category" href="#">Opinion</a>
                        - 12/21/2016
                    </span>
                    <span class="blog-grid-supplemental-title pull-right">
                        <a class="blog-grid-supplemental-category" href="#">News</a>
                        - 12/21/2016
                    </span>
                </div>
            </div>
        </article>
        <!-- End Blog Grid -->
    </div>
    @endforeach
    @endif
</div>
{!! $articles->fragment('pageScroll')->links() !!}
<!-- End Masonry Grid -->
@endsection