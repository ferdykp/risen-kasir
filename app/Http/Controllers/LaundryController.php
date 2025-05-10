<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Vinkla\Hashids\Facades\Hashids;




class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laundry = Laundry::paginate(10);
        return view('laundry.index', compact('laundry'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Generate unique order ID
        do {
            $order_id = 'ORD-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));
        } while (Laundry::where('order_id', $order_id)->exists());

        return view('laundry.create', compact('order_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|unique:data_laundry,order_id',
            'customer_name' => 'required|string|max:255',
            'phone_number' => [
                'required',
                'string',
                'regex:/^(\+?\d{1,4}[\s-]?)?(\(?\d{2,4}\)?[\s-]?)?[\d\s-]{6,}$/',
                'min:10',
                'max:17',
            ],
            'shoe_merch' => 'nullable|string|max:255',
            'shoe_color' => 'nullable|string|max:255',
            'service' => 'required',
            'price' => 'required|numeric',
            'note' => 'nullable|string',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'working_status' => 'required',
            'order_start' => 'required|date',
            'estimated' => 'required|date',
            'order_finish' => 'nullable|date',
            'address' => 'required'
        ]);

        if ($request->hasFile('picture')) {
            $validated['picture'] = $request->file('picture')->store('laundry_images', 'public');
        }

        Laundry::create($validated);

        return redirect()->route('laundry')->with('success', 'Order successfully created!');
    }

    public function show($id)
    {
        $laundry = Laundry::findOrFail($id);
        return view('laundry.detail', compact('laundry'));
    }

    // public function print($id)
    // {
    //     $laundry = Laundry::findOrFail($id);
    //     return view('laundry.print', compact('laundry'));
    // }
    // public function print($encrypted)
    // {
    //     try {
    //         $id = Crypt::decrypt($encrypted);
    //         $laundry = Laundry::findOrFail($id);
    //         return view('laundry.print', compact('laundry'));
    //     } catch (\Exception $e) {
    //         abort(404); // jika dekripsi gagal
    //     }
    // }
    public function print($hash)
    {
        $id = Hashids::decode($hash)[0] ?? null;

        if (!$id)
            abort(404);

        $laundry = Laundry::findOrFail($id);
        return view('laundry.print', compact('laundry'));
    }


    public function edit(string $id)
    { /* opsional */
    }

    public function update(Request $request, string $id)
    {
        $laundry = Laundry::findOrFail($id);

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => [
                'required',
                'string',
                'regex:/^(\+?\d{1,4}[\s-]?)?(\(?\d{2,4}\)?[\s-]?)?[\d\s-]{6,}$/',
                'min:10',
                'max:17',
            ],
            'shoe_merch' => 'nullable|string|max:255',
            'shoe_color' => 'nullable|string|max:255',
            'service' => 'required',
            'price' => 'required|numeric',
            'note' => 'nullable|string',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'working_status' => 'required',
            'order_start' => 'required|date',
            'estimated' => 'required|date',
            'order_finish' => 'nullable|date',
            'address' => 'required'
        ]);

        if ($request->hasFile('picture')) {
            // Hapus gambar lama jika ada
            if ($laundry->picture && \Storage::disk('public')->exists($laundry->picture)) {
                \Storage::disk('public')->delete($laundry->picture);
            }

            // Simpan gambar baru
            $validated['picture'] = $request->file('picture')->store('laundry_images', 'public');
        }

        $laundry->update($validated);

        return redirect()->route('laundry')->with('success', 'Order successfully updated!');
    }


    public function destroy(string $id)
    { /* opsional */
    }
}