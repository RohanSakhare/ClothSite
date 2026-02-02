@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Your Cart</h2>

    @if(empty($cart))
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
                    @php $total = $item['price'] * $item['qty']; $grand += $total; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>₹{{ $item['price'] }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.update', $item['id']) }}">
                                @csrf
                                <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" class="form-control">
                            </form>
                        </td>
                        <td>₹{{ $total }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                                @csrf
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="text-end">Grand Total: ₹{{ $grand }}</h4>
    @endif
</div>
@endsection
