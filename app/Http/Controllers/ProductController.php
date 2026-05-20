<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    // Menampilkan halaman daftar produk
    public function index()
    {
        // Ambil semua kategori untuk dropdown form
        $category = Category::all();

        // Ambil semua brand untuk dropdown form
        $brand = Brand::all();

        // Ambil semua produk beserta relasi category dan brand
        $products = Product::with('category', 'brand')->get();

        // Kirim data ke view product.blade.php
        return view('product', compact('products', 'category', 'brand'));
    }

    // Menyimpan produk baru ke database
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name'  => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,category_id',
            'brand_id'      => 'required|exists:brands,brand_id',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|integer',
        ]);

        Product::create($validateData);

        return redirect()->route('products')->with('success', 'Produk berhasil ditambahkan!');
    }
}