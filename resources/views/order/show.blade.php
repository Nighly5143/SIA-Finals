@extends('home')

@section('content')
<h1>Order Details</h1>

<p><strong>Order ID:</strong> {{ $order->id }}</p>
<p><strong>Total Price:</strong> ₱{{ $order->total_price }}</p>

<h2>Foods Ordered</h2>
<ul>
    @foreach($orderDetails as $detail)
        <li>{{ $detail->name }} - Quantity: {{ $detail->pivot->quantity }} - Price: ₱{{ $detail->pivot->total_price }}</li>
    @endforeach
</ul>

<h2>QR Code</h2>
<div>
    {!! $qrCode !!}
</div>
@endsection
