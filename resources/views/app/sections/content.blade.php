<div class="content">
    <div class="order-tab">
        <span>Сортировать:</span>
        <nav class="nav">
            <a class="nav-link active" aria-current="page" href="#">По цене</a>
            <a class="nav-link" href="#">По цене</a>
            <a class="nav-link" href="#">По названию</a>
            <a class="nav-link" href="#">По названию</a>
        </nav>
    </div>
    <ul class="list-group list-group-flush">
        @foreach($products as $product)
            <li class="list-group-item">{{$product->name}} - {{$product->price->price}} руб.</li>
        @endforeach
    </ul>
</div>
