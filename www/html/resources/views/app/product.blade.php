@extends('layouts/app')

@section('content')
    @include('app.sections.bread')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Карточка товара</h5>
            <p class="card-text">{{$product->name}}</p>
            <p class="card-text"><small class="text-muted">Цена: {{$product->price->price}} руб.</small></p>
        </div>
    </div>
@endsection