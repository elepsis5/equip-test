<ul class="list-group">
    @foreach($menu as $item)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="">{{$item['name']}}</a>
            <span class="badge bg-primary rounded-pill"></span>
        </li>
    @endforeach
</ul>