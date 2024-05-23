@extends('home')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>  
<!-- Modal -->
<div class="modal fade" id="deleteFoodModal" tabindex="-1" aria-labelledby="deleteFoodModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteFoodModalLabel">Delete Food - {{ $food->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('food/delete/' . $food->id) }}" method="POST">
                @csrf 
                @method('DELETE')
                <div class="modal-body">
                    Are you sure you want to delete this food item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Food</button>
                </div>
            </form>
        </div>
    </div>
</div>
  
<h1>Edit Food</h1>
<div class="row justify-content-center">
    <div class="col-md-5">
        <form action="{{ url('food/' . $food->id) }}" method="POST">
            @csrf 
            @method('PUT')
            <div class="form-group mt-2">
                <label for="name">Name</label>
                <input type="text" name='name' class='form-control' value='{{ $food->name }}'>
                @error('name')
                    <p class='text-danger'>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="description">Description</label>
                <input type="text" name='description' class='form-control' value='{{ $food->description }}'>
                @error('description')
                    <p class='text-danger'>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="price">Price</label>
                <input type="text" name='price' class='form-control' value='{{ $food->price }}'>
                @error('price')
                    <p class='text-danger'>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="imageUrl">Image URL</label>
                <input type="text" name='imageUrl' class='form-control' value='{{ $food->imageUrl }}'>
                @error('imageUrl')
                    <p class='text-danger'>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group my-3 d-grid gap-2 d-md-flex justify-content-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteFoodModal">
                    Delete Food
                </button>
                <button class="btn btn-primary">
                    Update Food
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
