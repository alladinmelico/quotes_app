@extends('layouts.master')

@section('title')
 laravel shopping cart
@endsection

@section('content')
    <div class="container">
        @foreach ($products->chunk(2) as $productChunk)
        <div class="row m-3">
            @foreach ($productChunk as $product)
                <div class="col-sm">
                    <div class="thumbnail border rounded-lg p-4 text-auto">
                        <img src="{{ $product->imagePath }}" alt="..." class="img-fluid">
                        <div class="caption">
                            <h3>{{ $product->title }}</h3>
                            <p class="description">{{ $product->description }}</p>
                            <div class="clearfix">
                                <div class="pull-left price">${{ $product->price }}</div>
                                <a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-success pull-right" role="button">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endforeach
    </div>
@endsection
