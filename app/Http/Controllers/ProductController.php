<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan semua produk.
     */
    public function index()
    {
        $product = Product::with('category')->paginate(10); // paginate 10 item per halaman
        return view('product.index', compact('product'));
    }

    /**
     * Menampilkan form tambah produk.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('name', 'price', 'stock', 'category');

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('product', 'public');
        }

        Product::create($data);




        return redirect()->route('product')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit produk.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui data produk.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('name', 'price', 'stock', 'category');

        if ($request->hasFile('picture')) {
            if ($product->picture && Storage::disk('public')->exists($product->picture)) {
                Storage::disk('public')->delete($product->picture);
            }
            $data['picture'] = $request->file('picture')->store('product', 'public');
        }

        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diupdate');
    }

    /**
     * Menghapus produk.
     */
    public function destroy(Product $product)
    {
        if ($product->picture && Storage::disk('public')->exists($product->picture)) {
            Storage::disk('public')->delete($product->picture);
        }

        $product->delete();

        return redirect()->route('index')->with('success', 'Produk berhasil dihapus');
    }
}
