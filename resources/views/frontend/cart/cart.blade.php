@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Your Cart</h2>

    @if(! $cart || $cart->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th width="120">Qty</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $grand = 0; @endphp
                @foreach($cart as $item)
                    @php $total = $item->price * $item->quantity; $grand += $total; @endphp
                    <tr data-item-id="{{ $item->id }}" data-price="{{ $item->price }}" data-stock="{{ $item->stock ?? 0 }}">
                        <td>
                            @if($item->product)
                                <a href="{{ route('product.show', $item->product) }}" class="d-flex align-items-center text-decoration-none text-body">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" style="width:48px;height:48px;object-fit:cover;margin-right:8px;border-radius:6px">
                                    @endif
                                    <div>
                                        <div>{{ $item->name }}</div>
                                        @if($item->size || $item->color)
                                            <small class="text-muted">{{ $item->size ?? '' }} {{ $item->color ?? '' }}</small>
                                        @endif
                                    </div>
                                </a>
                            @else
                                <div class="d-flex align-items-center">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" style="width:48px;height:48px;object-fit:cover;margin-right:8px;border-radius:6px">
                                    @endif
                                    <div>
                                        <div>{{ $item->name }}</div>
                                        @if($item->size || $item->color)
                                            <small class="text-muted">{{ $item->size ?? '' }} {{ $item->color ?? '' }}</small>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td>₹{{ $item->price }}</td>
                        <td>
                            <div>
                                <input type="number" name="qty" value="{{ $item->quantity }}" min="1" class="form-control cart-qty" data-original="{{ $item->quantity }}" aria-label="Quantity">
                                <div class="small text-danger stock-warning d-none">Only {{ $item->stock ?? 0 }} available</div>
                            </div>
                        </td>
                        <td class="item-total">₹{{ $total }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.remove', $item) }}">
                                @csrf
                                <button class="btn btn-sm btn-danger remove-item-btn">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end mb-3">
            <button id="applyChangesBtn" class="btn btn-primary" disabled>Apply Changes</button>
        </div>

        <div id="applyResult" class="text-end mb-2"></div>

        <h4 id="grandTotal" class="text-end">Grand Total: <span id="grandNumber">₹{{ number_format($grand, 2) }}</span></h4>
    @endif
</div>

@push('scripts')
    <style>
        .value-flash-up { color: #218838; transform: scale(1.02); transition: transform .25s ease, color .25s ease; }
        .value-flash-down { color: #c82333; transform: scale(0.98); transition: transform .25s ease, color .25s ease; }
        .anim-count { display: inline-block; min-width: 80px; }
        .stock-warning { margin-top: .35rem; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrf = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';

            function formatNumber(n) {
                return Number(n).toFixed(2);
            }

            // simple HTML escaper for messages coming from server
            function escapeHtml(s) {
                return String(s)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');
            }

            // animate numeric value from start to end over duration (ms)
            function animateNumber(el, start, end, duration = 350) {
                start = Number(start) || 0;
                end = Number(end) || 0;
                const startTime = performance.now();

                return new Promise((resolve) => {
                    function tick(now) {
                        const elapsed = now - startTime;
                        const t = Math.min(1, elapsed / duration);
                        // ease out cubic (t = t - 1; ease = t*t*t + 1)
                        const tt = t - 1;
                        const ease = tt * tt * tt + 1;
                        const value = start + (end - start) * ease;
                        el.innerText = '₹' + formatNumber(value);
                        if (elapsed < duration) {
                            requestAnimationFrame(tick);
                        } else {
                            el.innerText = '₹' + formatNumber(end);
                            resolve();
                        }
                    }
                    requestAnimationFrame(tick);
                });
            }

            function flashElement(el, type) {
                if (!el) return;
                const cls = type === 'up' ? 'value-flash-up' : 'value-flash-down';
                el.classList.add(cls);
                setTimeout(() => el.classList.remove(cls), 400);
            }

            const qtyInputs = document.querySelectorAll('.cart-qty');

            function computeGrandFromInputs() {
                let sum = 0;
                document.querySelectorAll('tr[data-price]').forEach(row => {
                    const p = parseFloat(row.dataset.price) || 0;
                    const inp = row.querySelector('.cart-qty');
                    const qv = inp ? (parseInt(inp.value, 10) || 0) : 0;
                    sum += p * Math.max(1, qv);
                });
                return sum;
            }

            qtyInputs.forEach((input) => {
                const tr = input.closest('tr');
                const itemTotalEl = tr.querySelector('.item-total');
                const stockWarning = tr.querySelector('.stock-warning');
                const price = parseFloat(tr.dataset.price) || 0;
                const stock = parseInt(tr.dataset.stock || 0, 10);

                function handleQtyChange() {
                    let q = parseInt(input.value, 10);
                    if (!isFinite(q) || q < 1) {
                        q = 1;
                        input.value = q;
                    }

                    const prev = Number(String(itemTotalEl.innerText).replace(/[^0-9.-]+/g, '')) || 0;
                    const newTotal = price * q;

                    // animate item total and ensure final value
                    animateNumber(itemTotalEl, prev, newTotal, 300).then(() => {
                        itemTotalEl.innerText = '₹' + formatNumber(newTotal);
                    });

                    // flash up/down
                    if (newTotal > prev) flashElement(itemTotalEl, 'up');
                    else if (newTotal < prev) flashElement(itemTotalEl, 'down');

                    // compute grand total from inputs (authoritative) and animate the numeric part only
                    const grandNumberEl = document.getElementById('grandNumber');
                    if (grandNumberEl) {
                        const currentGrand = Number(String(grandNumberEl.innerText).replace(/[^0-9.-]+/g, '')) || 0;
                        const sum = computeGrandFromInputs();
                        // debug
                        console.log('computeGrandFromInputs', { sum, price, q });
                        animateNumber(grandNumberEl, currentGrand, sum, 350).then(() => {
                            grandNumberEl.innerText = '₹' + formatNumber(sum);
                        });
                    }

                    // stock warning handling (visual only)
                    if (stock && q > stock) {
                        if (stockWarning) {
                            stockWarning.classList.remove('d-none');
                            stockWarning.innerText = `Only ${stock} available`;
                        }
                        input.classList.add('is-invalid');
                    } else {
                        if (stockWarning) stockWarning.classList.add('d-none');
                        input.classList.remove('is-invalid');
                    }

                    // mark changed rows visually and update apply button state
                    const original = parseInt(input.getAttribute('data-original') || 0, 10);
                    if (q !== original) {
                        tr.classList.add('table-warning');
                    } else {
                        tr.classList.remove('table-warning');
                    }
                    updateApplyButtonState();
                }

                input.addEventListener('input', handleQtyChange);
                input.addEventListener('change', handleQtyChange);
                input.addEventListener('keyup', handleQtyChange);

            });

            // track original quantities
            const originalQty = new Map();
            document.querySelectorAll('tr[data-item-id]').forEach(row => {
                const id = row.dataset.itemId;
                const inp = row.querySelector('.cart-qty');
                originalQty.set(String(id), parseInt(inp.getAttribute('data-original') || inp.value || 0, 10));
            });

            const applyBtn = document.getElementById('applyChangesBtn');
            const applyResult = document.getElementById('applyResult');

            function anyChanges() {
                for (const [id, orig] of originalQty.entries()) {
                    const row = document.querySelector(`tr[data-item-id="${id}"]`);
                    const val = parseInt(row.querySelector('.cart-qty').value, 10) || 0;
                    if (val !== orig) return true;
                }
                return false;
            }

            function updateApplyButtonState() {
                if (!applyBtn) return;
                if (anyChanges()) {
                    applyBtn.disabled = false;
                    applyBtn.classList.remove('btn-secondary');
                    applyBtn.classList.add('btn-dark');
                } else {
                    applyBtn.disabled = true;
                    applyBtn.classList.remove('btn-primary');
                    applyBtn.classList.add('btn-secondary');
                }
            }

            // wire apply button
            if (applyBtn) {
                updateApplyButtonState();

                applyBtn.addEventListener('click', function () {
                    if (applyBtn.disabled) return;
                    const changed = [];
                    for (const [id, orig] of originalQty.entries()) {
                        const row = document.querySelector(`tr[data-item-id="${id}"]`);
                        const val = parseInt(row.querySelector('.cart-qty').value, 10) || 0;
                        if (val !== orig) changed.push({ id: parseInt(id, 10), quantity: val });
                    }
                    if (!changed.length) return;

                    applyBtn.disabled = true;

                    fetch("{{ route('cart.apply') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf
                        },
                        body: JSON.stringify({ items: changed })
                    }).then(response => {
                        if (!response.ok) throw response;
                        return response.json();
                    }).then(data => {
                        if (data.success) {
                            (data.items || []).forEach(it => {
                                const row = document.querySelector(`tr[data-item-id="${it.id}"]`);
                                if (!row) return;
                                const inp = row.querySelector('.cart-qty');
                                const itemTotalEl = row.querySelector('.item-total');
                                const prev = Number(String(itemTotalEl.innerText).replace(/[^0-9.-]+/g, '')) || 0;
                                const newTotal = Number(it.total) || 0;
                                animateNumber(itemTotalEl, prev, newTotal, 300).then(() => {
                                    itemTotalEl.innerText = '₹' + formatNumber(newTotal);
                                });
                                inp.value = it.quantity;
                                inp.setAttribute('data-original', it.quantity);
                                originalQty.set(String(it.id), it.quantity);
                                row.classList.remove('table-warning');

                                const stockWarning = row.querySelector('.stock-warning');
                                if (it.clamped) {
                                    if (stockWarning) { stockWarning.classList.remove('d-none'); stockWarning.innerText = `Only ${it.available} available`; }
                                    inp.classList.add('is-invalid');
                                } else {
                                    if (stockWarning) stockWarning.classList.add('d-none');
                                    inp.classList.remove('is-invalid');
                                }
                            });

                            // animate grand
                            const grandNumberEl = document.getElementById('grandNumber');
                            if (grandNumberEl) {
                                const currentGrand = Number(String(grandNumberEl.innerText).replace(/[^0-9.-]+/g, '')) || 0;
                                const newGrand = Number(data.grand_total) || computeGrandFromInputs();
                                animateNumber(grandNumberEl, currentGrand, newGrand, 400).then(() => {
                                    grandNumberEl.innerText = '₹' + formatNumber(newGrand);
                                });
                            }

                            // show success via SweetAlert2
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({ icon: 'success', title: 'Cart updated', showConfirmButton: false, timer: 1800 });
                            } else {
                                applyResult.innerHTML = '<div class="alert alert-success d-inline-block">Cart updated</div>';
                                setTimeout(() => applyResult.innerHTML = '', 3000);
                            }

                            // show server-returned warnings (if any)
                            if (data.warnings && data.warnings.length) {
                                const html = data.warnings.map(escapeHtml).join('<br>');
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({ icon: 'warning', title: 'Some quantities adjusted', html });
                                } else {
                                    applyResult.innerHTML = '<div class="alert alert-warning d-inline-block">' + html + '</div>';
                                }
                            }
                        } else {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire('Update failed', '', 'error');
                            } else {
                                applyResult.innerHTML = '<div class="alert alert-danger d-inline-block">Update failed</div>';
                                setTimeout(() => applyResult.innerHTML = '', 4000);
                            }
                        }
                    }).catch(err => {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire('Update error', '', 'error');
                        } else {
                            applyResult.innerHTML = '<div class="alert alert-danger d-inline-block">Update error</div>';
                            setTimeout(() => applyResult.innerHTML = '', 4000);
                        }
                    }).finally(() => {
                        updateApplyButtonState();
                    });
                });
            }
        });
    </script>
@endpush
@endsection
