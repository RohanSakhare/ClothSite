@extends('layouts.main')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">

                {{-- MAIN IMAGE --}}
                <div class="position-relative text-center mb-3">
                    <img id="mainImage" src="{{ asset('storage/' . $product->images[0]->image) }}" class="img-fluid"
                        style="max-height: 450px; object-fit: contain;">
                    {{-- ARROWS --}}
                    <button class="btn btn-light position-absolute top-50 start-0 translate-middle-y"
                        onclick="prevImage()">‹</button>

                    <button class="btn btn-light position-absolute top-50 end-0 translate-middle-y"
                        onclick="nextImage()">›</button>
                </div>

                {{-- THUMBNAILS --}}
                <div class="d-flex gap-2 justify-content-center">
                    @foreach ($product->images as $index => $img)
                        <img src="{{ asset('storage/' . $img->image) }}" class="img-thumbnail thumb"
                            style="width: 70px; height: 70px; object-fit: cover; cursor: pointer;"
                            onclick="changeImage({{ $index }})">
                    @endforeach
                </div>
            </div>

            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p class="text-muted">{{ $product->category->name }}</p>
                <h4 class="fw-bold">₹{{ $product->price }}</h4>
                <p>{{ $product->description }}</p>

                <form method="POST" action="{{ route('cart.add', $product) }}">
                    @csrf
                    <button class="btn btn-dark">Add to Cart</button>
                </form>

            </div>
        </div>
    </div>
    <script>
        function changeImage(el) {
            document.getElementById('mainImage').src = el.src;
        }
    </script>
@endsection
