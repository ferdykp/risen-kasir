<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Facades\Storage;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase = Purchase::paginate(10);
        $totalPurchase = Purchase::sum('price'); // Hitung total invest
        return view('purchase.index', compact('purchase', 'totalPurchase'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'price' => preg_replace('/[^0-9]/', '', $request->price),
        ]);
        $validated = $request->validate([
            'object_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|in:Ml,Paket,Pcs,Gram',
            'price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'pict_nota' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Hitung total harga
        $validated['total_price'] = $validated['quantity'] * $validated['price'];

        // Upload gambar jika ada
        if ($request->hasFile('pict_nota')) {
            $path = $request->file('pict_nota')->store('nota_images', 'public');
            $validated['pict_nota'] = $path;
        }

        // Simpan ke database
        Purchase::create($validated);

        return redirect()->route('purchase')->with('success', 'Data pembelian berhasil disimpan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        return view('purchase.edit', compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $request->merge([
            'price' => preg_replace('/[^0-9]/', '', $request->price),
        ]);
        $validated = $request->validate([
            'object_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|in:Ml,Paket,Pcs,Gram',
            'price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'pict_nota' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Hitung total harga
        $validated['total_price'] = $validated['quantity'] * $validated['price'];

        // Upload gambar jika ada
        if ($request->hasFile('pict_nota')) {
            $path = $request->file('pict_nota')->store('nota_images', 'public');
            $validated['pict_nota'] = $path;
        }

        // Simpan ke database
        $purchase->update($validated);

        return redirect()->route('purchase')->with('success', 'Update Success.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::findOrFail($id);

        // Periksa dan hapus gambar nota jika ada
        if ($purchase->pict_nota && Storage::disk('public')->exists($purchase->pict_nota)) {
            Storage::disk('public')->delete($purchase->pict_nota);
        }

        // Hapus record pembelian
        $purchase->delete();
        return redirect()->route('purchase')->with('success', 'Orderan berhasil dihapus.');
    }

}
