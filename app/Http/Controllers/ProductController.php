<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->only([
            'name',
            'image_url',
            'price',
            'description'
        ]));

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Product không tồn tại'], 404);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Product không tồn tại'], 404);

        $product->update($request->only([
            'name',
            'image_url',
            'price',
            'description'
        ]));

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Product không tồn tại'], 404);

        $product->delete();
        return response()->json(['message' => 'Product đã bị xoá']);
    }
}
