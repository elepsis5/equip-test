@if(array_key_exists('child', $group))
    <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
            <a href="{{route('toGroup', $group['id'])}}">{{$group['name']}}</a>
            <span class="badge rounded-pill">{{getQuantityOfProducts($group)}}</span>
        </button>
@else
    <li class="list-group-item justify-content-between align-items-center subgroup">
        <a href="{{route('toGroup', $group['id'])}}">{{$group['name']}}</a>
        <span class="badge rounded-pill">{{getQuantityOfProducts($group)}}</span>
@endif
</li>
@if (array_key_exists('child', $group) && in_array($group['id'], $bread))
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
        @foreach($group['child'] as $group)
            @include('app.sections.menu', $group)
        @endforeach
    </ul>
@endif