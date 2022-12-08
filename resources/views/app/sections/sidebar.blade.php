{{--<div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">--}}
{{--    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">--}}
{{--        <svg class="bi me-2" width="30" height="24">--}}
{{--            <use xlink:href="#bootstrap"></use>--}}
{{--        </svg>--}}
{{--        <span class="fs-5 fw-semibold">Collapsible</span>--}}
{{--    </a>--}}
{{--    <ul class="list-unstyled ps-0">--}}

{{--        @foreach($menu as $item)--}}
{{--            @if(in_array($bread, $item['id']))--}}

{{--            @endif--}}
{{--            <li class="list-group-item d-flex justify-content-between align-items-center">--}}
{{--                <a href="{{route('toGroup', $item['id'])}}">{{$item['name']}}</a>--}}
{{--                <span class="badge bg-primary rounded-pill">{{}}</span>--}}
{{--            </li>--}}
{{--        @endforeach--}}
{{--    </ul>--}}
{{--</div>--}}


@if (count($menu) > 0)
    <ul>
        @foreach ($menu as $group)
            @include('app.sections.menu', $group)
        @endforeach
    </ul>
@else
    @include('app.sections.empty')
@endif