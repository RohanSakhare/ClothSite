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
                        @php
                            // pick first image by position if available, else fall back to product image
                            $firstImage = $product->images->sortBy('position')->first();
                            $imagePath = $firstImage ? $firstImage->image : ($product->image ?? null);
                        @endphp

                        <img src="{{ $imagePath ? asset('storage/' . $imagePath) : asset('frontend/images/no-image.png') }}" alt="{{ $product->name }}" class="card-img-top" style="object-fit:cover;">

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
