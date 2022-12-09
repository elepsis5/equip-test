<div class="header flex-shrink-0 p-3 bg-white">
    <div class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
        <svg class="bi me-2" width="30" height="24">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-5 fw-semibold">Каталог</span>
    </div>
</div>
<div class="content">
    <div class="order-tab">
        <span>Сортировать:</span>
        <nav class="nav">
            <a class="nav-link active" aria-current="page" href="{{route('toSort', [myRoute('id'), 'priceAsc'])}}">По
                цене
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-arrow-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                </svg>
            </a>
            <a class="nav-link" href="{{route('toSort', [myRoute('id'), 'priceDesc'])}}">По цене
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-arrow-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                </svg>
            </a>
            <a class="nav-link" href="{{route('toSort', [myRoute('id'), 'nameAsc'])}}">По названию
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-arrow-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                </svg>
            </a>
            <a class="nav-link" href="{{route('toSort', [myRoute('id'), 'nameDesc'])}}">По названию
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-arrow-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                </svg>
            </a>
        </nav>
    </div>
    <ul class="list-group list-group-flush">
        @foreach($products as $product)
            <li class="list-group-item"><a
                        href="{{route('product', [$product->id_group, $product->id])}}">{{$product->name}}
                    - {{$product->price}} руб.</a></li>
        @endforeach
    </ul>

    <div class="quantity">
        <span>Товаров на странице: </span>
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true"><a
                            href="{{route('toSort', [myRoute('id'), 'nameAsc', 6])}}">6</a>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><a
                            href="{{route('toSort', [myRoute('id'), 'nameAsc', 12])}}">12</a>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                        type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><a
                            href="{{route('toSort', [myRoute('id'), 'nameAsc', 18])}}">18</a>
                </button>
            </li>
        </ul>
    </div>
</div>

