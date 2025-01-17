<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\ProductImage;

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
    $products = Product::select(['id', 'price', 'name', 'description'])
        ->with([
            'images:product_id,image_url',
            'productAttributes' => function ($query) {
                $query->with('attributeImages:attribute_id,image_url');
            },
        ])
        ->orderBy('id', 'DESC')
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
Route::post('/products', function (Request $request) {
    // Lấy dữ liệu từ request
    $data = $request->only(['price', 'name', 'description']);

    // Tạo một bản ghi mới cho Product
    $newProduct = new Product();
    $newProduct->name = $data['name'];
    $newProduct->price = $data['price'];
    $newProduct->description = $data['description'];

    // Sự kiện sau khi lưu
    $newProduct->saved(function ($newProduct) {
        // Tạo một bản ghi mới cho ProductImage sau khi lưu Product
        $newProductImage = new ProductImage();
        $newProductImage->product_id = $newProduct->id; // Gán id của Product
        $newProductImage->image_url = 'https://fastly.picsum.photos/id/237/200/300.jpg?hmac=TmmQSbShHz9CdQm0NkEjx1Dyh_Y984R9LpNrpvH2D_U';
        $newProductImage->save();
    });

    $newProduct->save();

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
