@extends('home')

@section('content')
<h1>Orders List</h1>

@if (session('info'))
    <div class="alert alert-success">{{ session('info') }}</div>
@endif

<a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create New Order</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Total Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>₱{{ $order->total_price }}</td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
