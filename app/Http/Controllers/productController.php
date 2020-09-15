<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;
use App\Cart;
use App\User;
use App\Order;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
class productController extends Controller
{
    public function index(){
    	$products = product::all();
    	return view('shop/index')->with('products',$products);
    }
    public function getaddtocart(Request $request,$id){
    	$product = Product::find($id);
    	$oldCart = Session::has(auth()->id().'cart') ? Session::get(auth()->id().'cart') : null;
    	$cart = new Cart($oldCart);
    	$cart->add($product,$product->id);
    	session()->put(auth()->id().'cart', $cart);
    	//dd(session()->get('cart'));
    	return redirect()->route('products');
    }
    public function getCart(){
    	if(!Session::has(auth()->id().'cart')){
    		return view('shop/cartShopping');
    	}
    	$oldCart = Session::get(auth()->id().'cart');
    	  $cart = new Cart($oldCart);
    //  dd($cart->items);
    	  return view('shop/cartShopping')
    	  ->with('products',$cart->items)
    	 ->with('totalPrice',$cart->totalPrice);
    }
    public function checkout(){
     if(!Session::has(auth()->id().'cart')){
     return view('shop/cartShopping');
    	}
     $oldCart = Session::get(auth()->id().'cart');
     $cart = new Cart($oldCart);
     $total = $cart->totalPrice;
     return view('shop.checkout')->with('total',$total);
    }
    public function charge(Request $request){
     $charge = Stripe::charges()->create([
    'source' => $request->stripeToken,
    'currency' => 'USD',
    'amount'   => $request->total,
]);
     $chargeid = $charge['id'];
     if($chargeid){
     	auth()->user()->orders()->create([
          'cart' => serialize(session()->get(auth()->id().'cart'))
            ]);
     	session()->forget(auth()->id().'cart');
     	return redirect()->route('products');
     }
     else{
     	return redirect()->back();
     }

    }
     public function getReduceByOne($id) {
      $oldCart = Session::has(auth()->id().'cart') ? Session::get(auth()->id().'cart') : null;
      $cart = new Cart($oldCart);
         $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put(auth()->id().'cart', $cart);
        } else {
            Session::forget(auth()->id().'cart');
        }
        return redirect()->route('getCart');
     }

        public function getRemoveItem($id) {
        $oldCart = Session::has(auth()->id().'cart') ? Session::get(auth()->id().'cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put(auth()->id().'cart', $cart);
        } else {
            Session::forget(auth()->id().'cart');
        }

        return redirect()->route('getCart');
    }
}
