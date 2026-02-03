<div class="row">
    <div class="col-md-6">
        @php
            $images = $product->images->map(fn($i) => asset('storage/' . $i->image))->values();
        @endphp

        @if($images->count())
            <div id="product-viewer-{{ $product->id }}" data-images='@json($images)'>
                <div class="position-relative text-center mb-2">
                    <img id="product-main-img-{{ $product->id }}" src="{{ $images->first() }}" class="img-fluid mb-2" style="max-height:400px;object-fit:contain;width:100%">

                    <button type="button" class="btn btn-light position-absolute top-50 start-0 translate-middle-y" style="transform:translateY(-50%);" onclick="modalPrevImage({{ $product->id }})">‹</button>
                    <button type="button" class="btn btn-light position-absolute top-50 end-0 translate-middle-y" style="transform:translateY(-50%);" onclick="modalNextImage({{ $product->id }})">›</button>
                </div>
            </div>
        @else
            <img src="{{ asset('frontend/images/no-image.png') }}" class="img-fluid mb-2">
        @endif
    </div>
    
    <div class="col-md-6">
        <h5 class="mb-2">{{ $product->name }}</h5>
        <p class="text-muted mb-1">{{ $product->category->name ?? '-' }}</p>
        <h4 class="fw-bold mb-3">₹{{ $product->price }}</h4>
        <p>{{ $product->description }}</p>
        <p class="mb-1"><strong>Stock:</strong> {{ $product->stock }}</p>
        <p class="mb-1"><strong>Status:</strong> {{ $product->status ? 'Active' : 'Inactive' }}</p>
    </div>
</div>
