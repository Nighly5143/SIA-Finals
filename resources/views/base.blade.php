@extends('home')

@section('content')
<div class="base-container">
<img src="{{ asset('cuisine.jpg') }}" alt="ghfdgh" class="rev">
</div>


<style>

.base-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 500px;
}

img{
    height: auto;
    width: 60%;

}
</style>
@endsection