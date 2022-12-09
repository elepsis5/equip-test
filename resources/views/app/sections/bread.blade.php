<ul>
    <li><a href="{{route('index')}}">Главная</a></li>
    @foreach($breadMenu as $item)
        <li><a href="{{route('toGroup', $item['id'])}}">{{$item['name']}}</a></li>
    @endforeach
</ul>
