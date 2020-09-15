@extends('layouts.app')
@section('content')
<div class="row">
	@foreach($products as $product)
	<div class="col-md-4 mt-3">
<div class="card">
  <img src="{{$product->imagePath}}" alt="..." class="img-responsive card-top-img" style="max-height: 250px;" >
  <div class="card-body">
    <h5 class="card-title">{{$product->title}}</h5>
    <p class="card-text">{{$product->description}}</p>
    <p class="float-left price" style="font-weight: bold;">{{$product->price}}$</p>
    <a href="{{route('products.addtocart',$product->id)}}" class="btn btn-primary float-right">add to the cart</a>
  </div>
</div>
</div>
@endforeach
</div>
@endsection