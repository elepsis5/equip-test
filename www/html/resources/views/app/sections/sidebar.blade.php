<div class="flex-shrink-0 p-3 bg-white">
    <a href="{{route('index')}}" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
        <svg class="bi me-2" width="30" height="24">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-5 fw-semibold">На главную</span>
    </a>
    @if (count($menu) > 0)
        <ul class="list-unstyled ps-0">
            @foreach ($menu as $group)
                @include('app.sections.menu', $group)
            @endforeach
        </ul>
    @else
        @include('app.sections.empty')
    @endif
</div>