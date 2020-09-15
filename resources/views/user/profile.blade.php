@extends('layouts.app')
@section('content')
 <div class="row">
        <div class="col-md-8">
            <h2>my Profile</h2>
            <hr>
            <h5>My Orders</h5>
            @foreach($carts as $cart)
                <div class="card mt-10">
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($cart->items as $item)
                                <li class="list-group-item">
                                    <span class="badge badge-primary">${{ $item['price'] }}</span>
                                    {{ $item['item']['title'] }} | {{ $item['qty'] }} Units
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">
                        <strong>Total Price: ${{ $cart->totalPrice }}</strong>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endsection