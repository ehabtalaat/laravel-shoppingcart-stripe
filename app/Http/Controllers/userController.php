<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Auth;
class userController extends Controller
{
    public function getsignup(){
    	return view('user/signup');
    }
    public function postsignup(Request $request){
    	  $this->validate($request, [
    	  	'name' => 'string|required',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4'
        ]);
    	$user = User::create([
    	  	"name" => $request->name,
    	  	"email" => $request->email,
    	  	"password" => bcrypt($request->password)
    	  ]);
    	  Auth::login($user);
    	  return redirect()->route('user.profile');
    }
     public function getsignin(){
    	return view('user/signin');
    }
    public function postsignin(Request $request){
    	  $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:4'
        ]);
    	 $credentials = $request->only('email', 'password');
           if (Auth::attempt($credentials)) {
            return redirect()->route('user.profile');
        }
      return redirect()->back();
    }
    public function profile(){
        $orders = auth()->user()->orders;
       $carts = $orders->transform( function( $cart, $key) {
            return unserialize($cart->cart);
        });
    	return view('user/profile')->with('carts',$carts);
    }
    public function logout(){
    	Auth::logout();
    	return redirect()->route('signin');
    }
}
