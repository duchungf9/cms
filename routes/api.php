<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Get all products
Route::get('/products', function(){
    $products = DB::table('products')->select(['id', 'price', 'title', 'image', 'description'])->orderBy('id', 'DESC')->get();
    return response()->json(['items' => $products]);
});

// Get a specific product by ID
Route::get('/products/{id}', function($id){
    $product = DB::table('products')->find($id);
    
    if(!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    return response()->json(['item' => $product]);
});

// Create a new product
Route::post('/products', function(Request $request){
    $data = $request->only(['price', 'title', 'image', 'description']);

    $productId = DB::table('products')->insertGetId($data);

    $newProduct = DB::table('products')->find($productId);

    return response()->json(['item' => $newProduct], 201);
});

// Update a product by ID
Route::put('/products/{id}', function(Request $request, $id){
    $product = DB::table('products')->find($id);

    if(!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $data = $request->only(['price', 'title', 'image', 'description']);

    DB::table('products')->where('id', $id)->update($data);

    $updatedProduct = DB::table('products')->find($id);

    return response()->json(['item' => $updatedProduct]);
});

// Delete a product by ID
Route::delete('/products/{id}', function($id){
    $product = DB::table('products')->find($id);

    if(!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    DB::table('products')->where('id', $id)->delete();

    return response()->json(['message' => 'Product deleted successfully']);
});
