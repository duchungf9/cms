<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

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
    $products = Product::select(['product_id', 'price', 'product_name', 'description'])
        ->with([
            'images:product_id,image_url',
            'productAttributes' => function ($query) {
                $query->with('attributeImages:attribute_id,image_url');
            },
        ])
        ->orderBy('product_id', 'DESC')
        ->get();

    return response()->json(['items' => $products]);
});

// Get a specific product by ID
Route::get('/products/{id}', function($id){
    $product = Product::find($id);
    
    if(!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    return response()->json(['item' => $product]);
});

// Create a new product
Route::post('/products', function(Request $request){
    $data = $request->only(['price', 'product_name', 'image', 'description']);

    $newProduct = Product::create($data);

    return response()->json(['item' => $newProduct], 201);
});

// Update a product by ID
Route::put('/products/{id}', function(Request $request, $id){
    $product = Product::find($id);

    if(!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $data = $request->only(['price', 'product_name', 'image', 'description']);

    $product->update($data);

    return response()->json(['item' => $product]);
});

// Delete a product by ID
Route::delete('/products/{id}', function($id){
    $product = Product::find($id);

    if(!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Product deleted successfully']);
});
