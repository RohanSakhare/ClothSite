@extends('layouts.main')

@section('content')
    <div class="container py-5">
        <div class="row">

            <div class="col-md-6">
                <div class="d-none">
                    @foreach ($product->images as $img)
                        <a href="{{ asset('storage/' . $img->image) }}" data-fancybox="product-{{ $product->id }}"
                            class="product-fancybox">
                            <img src="{{ asset('storage/' . $img->image) }}">
                        </a>
                    @endforeach
                </div>


                <style>
                    .thumb.active {
                        border: 2px solid black;
                    }
                </style>

                {{-- MAIN IMAGE (CLICK = ZOOM) --}}
                <div class="position-relative text-center mb-3">



                    <img id="mainImage" src="{{ asset('storage/' . $product->images[0]->image) }}" class="img-fluid"
                        style="max-height: 450px; object-fit: contain;" onclick="openZoom()">

                    {{-- ARROWS --}}
                    <button class="btn btn-light position-absolute top-50 start-0 translate-middle-y"
                        onclick="prevImage()">‹</button>

                    <button class="btn btn-light position-absolute top-50 end-0 translate-middle-y"
                        onclick="nextImage()">›</button>
                </div>

                {{-- THUMBNAILS --}}
                <div class="d-flex gap-2 justify-content-center">
                    @foreach ($product->images as $index => $img)
                        <img src="{{ asset('storage/' . $img->image) }}"
                            class="img-thumbnail thumb {{ $index === 0 ? 'active' : '' }}"
                            style="width:70px;height:70px;object-fit:cover;cursor:pointer"
                            onclick="changeImage({{ $index }})">
                    @endforeach
                </div>

            </div>


            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p class="text-muted">{{ $product->category->name }}</p>
                <h4 class="fw-bold">₹{{ $product->price }}</h4>
                @if ($product->variants->count())
                    <div class="mb-3">
                        <label for="sizeSelect" class="form-label fw-bold">Size</label>
                        <select id="sizeSelect" class="form-select" onchange="updateColors()">
                            <option value="">Select Size</option>
                            @foreach ($product->variants->pluck('size')->unique() as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="colorSelect" class="form-label fw-bold">Color</label>
                        <select id="colorSelect" class="form-select" onchange="setVariant()">
                            <option value="">Select Color</option>
                        </select>
                    </div>

                    <p id="stockInfo" class="fw-bold text-success d-none"></p>
                @endif

                <p>{{ $product->description }}</p>

                <form method="POST" action="{{ route('cart.add', $product) }}">
                    @csrf
                    <input type="hidden" name="variant_id" id="variantInput">

                    <button class="btn btn-dark" id="addToCartBtn" type="submit" disabled>Add to Cart</button>
                </form>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const images = @json($product->images->pluck('image'));
            let currentIndex = 0;

            const mainImage = document.getElementById('mainImage');

            const group = "product-{{ $product->id }}";
            const items = images.map(src => ({
                src: '/storage/' + src,
                type: 'image'
            }));

            window.changeImage = function(index) {
                currentIndex = index;
                mainImage.src = '/storage/' + images[index];

                document.querySelectorAll('.thumb').forEach((t, i) => {
                    t.classList.toggle('active', i === index);
                });
            }

            window.nextImage = function() {
                currentIndex = (currentIndex + 1) % images.length;
                changeImage(currentIndex);
            }

            window.prevImage = function() {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                changeImage(currentIndex);
            }

            window.openZoom = function(index) {
                const idx = (typeof index === 'number') ? index : currentIndex;
                const safeIdx = (idx >= 0 && idx < images.length) ? idx : 0;
                if (typeof Fancybox !== 'undefined' && Fancybox) {
                    Fancybox.show(items, {
                        startIndex: safeIdx,
                        Thumbs: {
                            autoStart: true
                        },
                        Toolbar: {
                            display: ['close']
                        },
                        Carousel: {
                            infinite: true,
                            preload: 2
                        }
                    });
                } else {
                    // Fallback: trigger anchor if Fancybox not available
                    const anchors = document.querySelectorAll('[data-fancybox="product-{{ $product->id }}"]');
                    if (anchors[safeIdx]) anchors[safeIdx].click();
                }
            }
        });
    </script>
    <script>
        const variants = @json($product->variants);
        const colorSelect = document.getElementById('colorSelect');
        const sizeSelect = document.getElementById('sizeSelect');
        const stockInfo = document.getElementById('stockInfo');
        const variantInput = document.getElementById('variantInput');
        const addToCartBtn = document.getElementById('addToCartBtn');

        function updateColors() {
            colorSelect.innerHTML = '<option value="">Select Color</option>';
            stockInfo.classList.add('d-none');
            variantInput.value = '';
            if (addToCartBtn) addToCartBtn.disabled = true;

            const selectedSize = sizeSelect.value;
            if (!selectedSize) return;

            // Map color -> first matching variant for selected size
            const colorMap = {};
            variants.forEach(v => {
                if (v.size === selectedSize && !colorMap[v.color]) {
                    colorMap[v.color] = v;
                }
            });

            Object.keys(colorMap).forEach(color => {
                const v = colorMap[color];
                const opt = document.createElement('option');
                opt.value = v.id; // variant id
                opt.text = color;
                opt.dataset.stock = v.stock;
                colorSelect.appendChild(opt);
            });
        }

        function setVariant() {
            const option = colorSelect.options[colorSelect.selectedIndex];
            if (!option || !option.value) return;

            const stock = Number(option.dataset.stock) || 0;
            const variantId = option.value;

            variantInput.value = variantId;

            // Show numeric count only when stock is less than 10
            if (stock === 0) {
                stockInfo.innerText = 'Out of stock';
                stockInfo.classList.remove('text-success');
                stockInfo.classList.add('text-danger');
            } else {
                stockInfo.innerText = stock < 10 ? `In stock: only ${stock} remaining` : 'In stock';
                stockInfo.classList.remove('text-danger');
                stockInfo.classList.add('text-success');
            }

            stockInfo.classList.remove('d-none');

            if (addToCartBtn) addToCartBtn.disabled = (stock === 0);
        }
    </script>

@endsection
