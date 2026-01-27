<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'rating' => 'required|numeric|min:0|max:5',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'images' => 'nullable|array|max:5', // Max 5 files
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'brand' => 'Samsung', // Enforce Samsung as per requirement
            'price' => $request->price,
            'rating' => $request->rating,
            'stock_quantity' => $request->stock_quantity,
            'description' => $request->description,
            'images' => $imagePaths,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Stock added successfully.');
    }
    public function edit(Product $product)
    {
        $categories = \App\Models\Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'rating' => 'required|numeric|min:0|max:5',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'images' => 'nullable|array|max:5', // Max 5 files per upload
        ]);

        $imagePaths = $product->images ? $product->images : [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Check if total images do not exceed 5
                if (count($imagePaths) >= 5) {
                    break;
                }
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'rating' => $request->rating,
            'stock_quantity' => $request->stock_quantity,
            'description' => $request->description,
            'images' => $imagePaths,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Stock updated successfully.');
    }
}
