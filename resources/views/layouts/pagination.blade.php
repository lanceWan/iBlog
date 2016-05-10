@if($paginator->getLastPage() > 1)
<div class="container">
    <!-- Paginations v2 -->
    <div class="paginations-v2 text-center">
        <ul class="paginations-v2-list">
            <li class="previous">
                <a href="{{ $paginator->getUrl(1) }}" aria-label="Previous" class="{{ ($paginator->getCurrentPage() == 1) ? ' disabled' : '' }}">
                    <span aria-hidden="true">Prev</span>
                </a>
            </li>
            @for ($i = 1; $i <= $paginator->getLastPage(); $i++)
                <li class="item{{ ($paginator->getCurrentPage() == $i) ? ' active' : '' }}"><a href="{{ $paginator->getUrl($i) }}">
                    {{ $i }}
                </a></li>
            @endfor
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li class="active"><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li class="next">
                <a href="{{ $paginator->getUrl(1) }}" aria-label="Next" class="{{ ($paginator->getCurrentPage() == 1) ? ' disabled' : '' }}">
                    <span aria-hidden="true">Next</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- End Paginations v2 -->
</div>
@endif