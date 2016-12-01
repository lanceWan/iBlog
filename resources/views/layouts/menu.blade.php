<header class="header-transparent navbar-fixed-top header-sticky">

    <nav class="navbar mega-menu" role="navigation">
        <div class="container">
            <div class="menu-container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="toggle-icon"></span>
                </button>
                <div class="navbar-actions">
                    <div class="navbar-actions-shrink search-fullscreen search-fullscreen-trigger-white">
                        <div class="search-fullscreen-trigger">
                            <i class="search-fullscreen-trigger-icon fa fa-search"></i>
                        </div>
                        <div class="search-fullscreen-overlay">
                            <div class="search-fullscreen-overlay-content">
                                <div class="search-fullscreen-input-group">
                                    <input type="text" class="form-control search-fullscreen-input" placeholder="Search for ...">
                                    <button class="search-fullscreen-search" type="button"><i class="search-fullscreen-search-icon fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="search-fullscreen-bg-overlay">
                            <div class="search-fullscreen-close">&times;</div>
                        </div>
                    </div>
                </div>

                <div class="navbar-logo">
                    <a class="navbar-logo-wrap" href="{{url('/')}}">
                        <img class="navbar-logo-img navbar-logo-img-white" src="{{asset('front/img/logo-default-white.png')}}" alt="Ark">
                        <img class="navbar-logo-img navbar-logo-img-dark" src="{{asset('front/img/logo-default.png')}}" alt="Ark">
                    </a>
                </div>
            </div>
            <div class="collapse navbar-collapse nav-collapse">
                <div class="menu-container">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="nav-item-child radius-3" href="{{url('/')}}">
                                Home
                            </a>
                        </li>
                        @if($categories)
                        @foreach($categories as $cate)
                        @if($cate['child'])
                            <li class="nav-item dropdown">
                            <a class="nav-item-child dropdown-toggle radius-3" href="javascript:void(0)" onclick="return false" data-toggle="dropdown">
                                {{$cate['name']}}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($cate['child'] as $v)
                                    <li class="dropdown-menu-item"><a class="dropdown-menu-item-child" href="{{url('cate/'.$v['id'])}}">{{$v['name']}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @else
                            <li class="nav-item">
                            <a class="nav-item-child radius-3" href="{{url('cate/'.$cate['id'])}}">
                                {{$cate['name']}}
                            </a>
                        </li>
                        @endif
                        @endforeach
                        @endif
                        <li class="nav-item">
                            <a class="nav-item-child radius-3" href="{{url('article/25')}}">
                                Laravel 视频教程
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item-child radius-3" href="{{url('article/65')}}">
                                Laravel5.3&Vue2.0系列
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>