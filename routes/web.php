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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('items','ItemsController');
Route::resource('Auction','AuctionController');

Route::get('/addauction/{id}','ItemsController@addauction')->name('addauction');
Route::get('/bid/{id}','AuctionController@bid')->name('bid');
Route::get('/end','AuctionController@end')->name('Auction.end');
