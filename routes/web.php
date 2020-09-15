<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'productController@index')->name('products');
Route::get('/signup', 'userController@getsignup')->name('signup')->middleware('guest');
Route::post('/signup', 'userController@postsignup')->name('user.signup')->middleware('guest');
Route::get('/signin', 'userController@getsignin')->name('signin')->middleware('guest');
Route::post('/signin', 'userController@postsignin')->name('user.signin')->middleware('guest');
Route::get('/profile', 'userController@profile')->name('user.profile')->middleware('auth');
Route::get('/logout', 'userController@logout')->name('logout')->middleware('auth');
Route::get('/addtocart/{id}','productController@getaddtocart')->name('products.addtocart');
Route::get('/getCart','productController@getCart')->name('getCart');
Route::get('/checkout','productController@checkout')->name('checkout')->middleware('auth');;
Route::post('/charge','productController@charge')->name('charge');
Route::get('/reduce/{id}','productController@getReduceByOne')->name('reduce');
Route::get('/remove/{id}','productController@getRemoveItem')->name('remove');