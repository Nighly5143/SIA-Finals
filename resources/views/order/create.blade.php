@extends('home')

@section('content')
<h1>Create Order</h1>

<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="food">Select Foods</label>
        @foreach($foods as $food)
            <div class="mb-2">
                <input type="checkbox" name="foods[{{ $food->id }}][food_id]" value="{{ $food->id }}">
                <label>{{ $food->name }} (₱{{ $food->price }})</label>
                <input type="number" name="foods[{{ $food->id }}][quantity]" min="1" value="1">
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Order</button>
</form>
@endsection
