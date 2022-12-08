<li>
    <a href="{{route('toGroup', $group['id'])}}">{{$group['name']}}</a>
    <span class="badge bg-primary rounded-pill">{{getQuantityOfProducts($group)}}</span>
</li>
@if (array_key_exists('child', $group) && in_array($group['id'], $bread))
    <ul>
        @foreach($group['child'] as $group)
            @include('app.sections.menu', $group)
        @endforeach
    </ul>
@endif