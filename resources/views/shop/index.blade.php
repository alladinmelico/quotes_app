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
                        <div class="caption m-3">
                            <h3>{{ $product->title }}<span>${{ $product->price }}</span></h3>
                            <p>{{ $product->description }}</p>
                            <div class="clearfix">
                                <a href="#" class="btn btn-primary" role="button"><i class="fa fa-cart-plus"></i> Add to Cart</a> <a href="#" class="btn btn-default pull-right" role="button"><i class="fa fa-info"></i> More Info</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endforeach
    </div>
@endsection
