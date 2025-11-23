<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return ApiResponse::success($products, 'Get all products successful', 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_url' => 'nullable|url',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'type' => 'nullable|string|max:100',
        ]);

        $product = Product::create($request->only([
            'name',
            'image_url',
            'price',
            'description',
            'quantity',
            'type',
        ]));

        return ApiResponse::success($product, 'Created successfully', 201);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) return ApiResponse::error('Product không tồn tại', 404);

        return ApiResponse::success($product, 'Get product successfully');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) return ApiResponse::error('Product không tồn tại', 404);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'image_url' => 'sometimes|nullable|url',
            'price' => 'sometimes|required|numeric|min:0',
            'description' => 'sometimes|nullable|string',
            'quantity' => 'sometimes|required|integer|min:0',
            'type' => 'sometimes|nullable|string|max:100',
        ]);

        $product->update($request->only([
            'name',
            'image_url',
            'price',
            'description',
            'quantity',
            'type',
        ]));

        return ApiResponse::success($product, "Updated successfully");
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) return ApiResponse::error("Product không tồn tại", 404);

        $product->delete();
        return ApiResponse::success("Product đã bị xóa");
    }
}
