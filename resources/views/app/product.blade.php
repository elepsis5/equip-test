@extends('layouts/app')

@section('content')
    @include('app.sections.bread')
<div>
    <p>{{$product->name}}</p>
    <p>{{$product->price->price}}</p>
</div>
@endsection