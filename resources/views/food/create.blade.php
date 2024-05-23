@extends('home')

@section('content')

    <h1 class="create text-center mb-4 " >Add New Food</h1>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <form action="{{ url('food/create') }}" method="POST">
                @csrf 
                <div class="form-group mt-2">
                    <label for="name">Name</label>
                    <input type="text" name='name' class='form-control'>
                    @error('name')
                        <p class='text-danger'>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="description">Description</label>
                    <input type="text" name='description' class='form-control'>
                    @error('description')
                        <p class='text-danger'>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="price">Price</label>
                    <input type="text" name='price' class='form-control'>
                    @error('price')
                        <p class='text-danger'>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="imageUrl">Image</label>
                    <input type="text" name='imageUrl' class='form-control'>
                    @error('imageUrl')
                        <p class='text-danger'>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group my-3 d-grid gap-2 d-md-flex justify-content-end">
                    <a href="{{ url('/food') }}" class='btn btn-danger mo-md-2' type='button'>
                        Back
                    </a>
                    <button class="btn btn-primary">
                        Add Food
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
