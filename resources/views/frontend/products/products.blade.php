@extends('layouts.main')

@section('content')
    <div class="container">
        <h2 class="mb-4">
            {{ isset($category) ? $category->name : 'All Products' }}
        </h2>


        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                       <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name }}" class="card-img-top" >

                        <div class="card-body">
                            <h6>{{ $product->name }}</h6>
                            <p class="fw-bold">₹{{ $product->price }}</p>
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-dark btn-sm w-100">
                                View Product
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h5>Products Coming Soon</h5>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
