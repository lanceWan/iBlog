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
        <h2 class="breadcrumbs-v1-title">{{$category}}</h2>
        <ol class="breadcrumbs-v1-links">
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="active">{{$category}}</li>
        </ol>
    </div>
</section>
@endsection
@section('content')
<div class="masonry-grid">
    @if($articles)
    @foreach($articles as $v)
    <div class="masonry-grid-item col-1">
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
                        <a class="blog-grid-supplemental-category" href="{{url('cate/'.$v->category_id)}}"><i class="fa fa-leaf"></i> {{$category}}</a>
                         -  <i class="fa fa-clock-o"></i> {{$v->created_at}}
                    </span>
                    <span class="blog-grid-supplemental-title pull-right">
                        <i class="fa fa-eye"></i> {{Redis::get(config('admin.global.redis.article_view').$v->id)}}
                    </span>
                </div>
            </div>
        </article>
    </div>
    @endforeach
    @endif
</div>
{!! $articles->links() !!}
@endsection