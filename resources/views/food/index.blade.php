@extends('home')

@section('content')

@if (session('info'))
    <div class="alert alert-success">{{ session('info') }}</div>
@endif

<style>
    .food-image {
        max-height: 160px;
        width: 100%;
        object-fit: cover;
    }

    .qr-code {
        margin-right: 10px;
        margin-top: 100px;
    }

    .card-body{
        position: relative;
    }

    .card-text-price{
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 120px;
        background-color: green;
        color: white;
        padding: 5px;
    }

    h5 {
        font-size: 30;
        text-transform: uppercase;
    }

    .btn-custom-red{
        background-color: yellow;
        color: #ffffff;
    }

    .btn-custom-green{
        background-color: green;
        color: #ffffff;
    }

    .text-md-end {
        text-align: right;
    }

</style>

<div class='d-grip gap-2 d-md-flex justify-content-between mb-3'>
    <a href="{{ url('/food/create') }}" class='btn btn-custom btn-custom-red mo-md-2' type='button'>
        Add New Food
    </a>
</div>

<div class="row">
    @foreach($foods as $food)
        <div class="col-md-12 mb-4">
            <div class="card position-relative">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="m-2">
                                <img src="{{$food->imageUrl}}" alt="Food Image" class="img-fluid food-image">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mt-2" id="title">{{ $food->name }}</h5>
                            <p class="card-text">Description: {{ $food->description }}</p>
                            <p class="card-text-price">Price: ₱{{ $food->price }}</p>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 end-0 m-2 d-flex flex-column align-items-end">
                    <div style="color: red;" class="qr-code mb-2">
                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(140)->generate($food->name) !!}
                    </div>
                    <a href="{{ url('/food/'.$food->id) }}" class="btn btn-danger ml-5">Edit</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class='d-grip gap-2 d-md-flex justify-content-between mb-3'>
    <div class="text-md-end w-100">
        <a href="#" class='btn btn-custom btn-custom-green mo-md-2 import-csv-btn' type='button'>
            Import CSV
        </a>
        <form action="{{ route('foods.import-csv') }}" method="POST" enctype="multipart/form-data" style="display: none;">
            @csrf
            <input type="file" name="csv_file" id="csv_file" accept=".csv" style="display: none;">
            <button type="submit" class="btn btn-custom btn-custom-green mo-md-2">Submit</button>
        </form>

        <a href="{{ url('/foods/csv-all') }}" class='btn btn-custom btn-custom-green mo-md-2' type='button'>
            Generate CSV
        </a>
        <a href="{{ url('/foods/pdf') }}" class='btn btn-custom btn-custom-green mo-md-2' type='button'>
            Generate PDF
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var importCsvBtn = document.querySelector('.import-csv-btn');
        var fileInput = document.querySelector('#csv_file');

        importCsvBtn.addEventListener('click', function(event) {
            event.preventDefault();
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            this.parentElement.submit();
        });
    });
</script>

@endsection
