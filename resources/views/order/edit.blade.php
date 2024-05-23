@extends('home')

@section('content')
<h1>Edit Order</h1>

<form action="{{ route('orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="food">Select Foods</label>
        @foreach($foods as $food)
            <div class="mb-2">
                <input type="checkbox" name="foods[{{ $food->id }}][food_id]" value="{{ $food->id }}"
                    {{ $order->foods->contains($food->id) ? 'checked' : '' }}>
                <label>{{ $food->name }} (₱{{ $food->price }})</label>
                <input type="number" name="foods[{{ $food->id }}][quantity]" min="1" value="{{ $order->foods->contains($food->id) ? $order->foods->find($food->id)->pivot->quantity : 1 }}">
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Update Order</button>
</form>
@endsection
