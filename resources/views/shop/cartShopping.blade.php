@extends('layouts.app')
@section('content')
@if(Session::has(auth()->id().'cart'))
<div class="row">
<div class="col-md-6 mx-auto">
<ul class="list-group">
	@foreach($products as $product)
	<li class="list-group-item">
		<strong>{{$product['item']['title']}}</strong>
		<span class="badge badge-success ml-5"> ${{$product['price']}}</span>
         <div class="dropdown d-inline ml-5">
  <button type="button" class="btn btn-primary btn-sm dropdown-toggle d-inline" data-toggle="dropdown">
    actions
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{route('reduce',$product['item']['id'])}}">Reduce by 1</a>
    <a class="dropdown-item" href="{{route('remove',$product['item']['id'])}}">Reduce All</a>
  </div>
</div> 
		<span class="badge badge-primary float-right">{{$product['qty']}}</span>	
	</li>
	@endforeach
	</ul>
</div>
</div>
     <div class="row mt-6">
            <div class="col-sm-6 col-md-6 mx-auto">
                <strong>Total: $ {{ $totalPrice }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 mx-auto">
                <a href ="{{route('checkout')}}" class="btn btn-success">Checkout</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <h2>No Items in Cart!</h2>
            </div>
        </div>

@endif
	@endsection