<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('index');
});



//Route che gestiscono la parte di login e registrazione
Route::get('index','App\Http\Controllers\LoginController@login_form');
Route::post('index','App\Http\Controllers\LoginController@do_login');
Route::get('register','App\Http\Controllers\LoginController@register_form');
Route::post('register','App\Http\Controllers\LoginController@do_register');
Route::get('logout','App\Http\Controllers\LoginController@logout');


//Route che gestiscono la home
Route::get('home','App\Http\Controllers\CollectionController@home');
Route::get('collection/list/{lettera}','App\Http\Controllers\CollectionController@do_list');


//Route che gestiscono la descrizione del gioco
Route::get('description','App\Http\Controllers\CollectionController@description_games');
Route::get('description/info/{steam_id}','App\Http\Controllers\CollectionController@do_description');

//Route che gestiscono il menu della home
Route::get('Gioca','App\Http\Controllers\MenuController@gioca');
Route::get('Top_5_Giochi','App\Http\Controllers\MenuController@Top_5');

//Route che gestiscono la wishlist
Route::post('wishlist/add','App\Http\Controllers\WishlistController@wishlist_add');
Route::get('wishlist/list','App\Http\Controllers\WishlistController@wishlist_list');
Route::get('wishlist/view','App\Http\Controllers\WishlistController@wishlist_view');
Route::post('wishlist/remove','App\Http\Controllers\WishlistController@wishlist_remove');
Route::get('wishlist/home','App\Http\Controllers\WishlistController@wishlist_view_home');


