<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index')}}">Главная</a></li>
        @foreach($breadMenu as $item)
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('toGroup', $item['id'])}}">{{$item['name']}}</a></li>
        @endforeach
    </ol>
</nav>