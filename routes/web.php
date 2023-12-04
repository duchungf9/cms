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
    return view('welcome');
});
Route::any('/media/upload', function(){
    

    return response()->json(['error' => 0]);
});

Route::any('/products/list', function(){
    $products = DB::table('products')->select(['id', 'price', 'title', 'image', 'description'])->orderBy('id', 'DESC')->get();
    return response()->json(['items' => $products]);
});