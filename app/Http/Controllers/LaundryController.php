<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Vinkla\Hashids\Facades\Hashids;

class LaundryController extends Controller
{
    public function index()
    {
        $laundry = Laundry::paginate(10);
        return view('laundry.index', compact('laundry'));
    }

    public function create()
    {
        do {
            $order_id = 'ORD-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));
        } while (Laundry::where('order_id', $order_id)->exists());

        return view('laundry.create', compact('order_id'));
    }

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
            // 'shoe_merch' => 'nullable|array',
            // 'shoe_merch.*' => 'nullable|string|max:255',
            // 'shoe_color' => 'nullable|array',
            // 'shoe_color.*' => 'nullable|string|max:255',
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

        // $shoePairs = [];
        // $shoe_merch = $request->input('shoe_merch', []);
        // $shoe_color = $request->input('shoe_color', []);
        // foreach ($shoe_merch as $index => $merch) {
        //     $shoePairs[] = [
        //         'merch' => $merch,
        //         'color' => $shoe_color[$index] ?? ''
        //     ];
        // }
        // $validated['shoes'] = json_encode($shoePairs);
        $shoePairs = [];
        $shoe_merch = $request->input('shoe_merch', []);
        $shoe_color = $request->input('shoe_color', []);
        foreach ($shoe_merch as $index => $merch) {
            $shoePairs[] = [
                'merch' => $merch,
                'color' => $shoe_color[$index] ?? ''
            ];
        }
        $validated['shoes'] = json_encode($request->input('shoes', []));


        if ($request->hasFile('picture')) {
            $validated['picture'] = $request->file('picture')->store('laundry_images', 'public');
        }

        Laundry::create($validated);

        return redirect()->route('laundry')->with('success', 'Order successfully created!');
    }

    // public function show($id)
    // {
    //     $laundry = Laundry::findOrFail($id);
    //     $shoes = json_decode($laundry->shoes, true); // Dekode JSON menjadi array

    //     if (json_last_error() != JSON_ERROR_NONE) {
    //         // Jika ada error dalam mendekode JSON
    //         dd("Error decoding JSON: " . json_last_error_msg());
    //     }
    //     dd($shoes);


    //     return view('laundry.detail', compact('laundry', 'shoes'));
    // }

    public function show($id)
    {
        $laundry = Laundry::findOrFail($id);

        // Hapus kutip ganda ekstra pada string JSON sebelum di-decode
        $shoes_raw = $laundry->shoes;

        // Jika masih ada kutipan ganda yang tidak valid, bersihkan dulu
        $shoes_clean = trim($shoes_raw, '"'); // hilangkan kutip luar
        $shoes_clean = stripslashes($shoes_clean); // hilangkan escape character

        // Decode JSON menjadi array
        $shoes = json_decode($shoes_clean, true);

        return view('laundry.detail', compact('laundry', 'shoes'));
    }





    public function printpdf($id)
    {
        $laundry = Laundry::findOrFail($id);
        $shoes = json_decode($laundry->shoes, true) ?? [];

        return view('laundry.printpdf', compact('laundry', 'shoes'));
    }

    public function print($hash)
    {
        $id = Hashids::decode($hash)[0] ?? null;
        if (!$id)
            abort(404);


        $laundry = Laundry::findOrFail($id);
        // Parse JSON shoes jika tersedia
        $shoes = json_decode($laundry->shoes, true) ?? [];

        return view('laundry.print', compact('laundry', 'shoes'));
    }



    public function edit(string $id)
    {
        $laundry = Laundry::findOrFail($id);
        return view('laundry.edit', compact('laundry'));
    }

    public function update(Request $request, string $id)
    {
        $laundry = Laundry::findOrFail($id);

        // Bersihkan format harga sebelum validasi
        $request->merge([
            'price' => preg_replace('/[^0-9]/', '', $request->price),
        ]);

        $validated = $request->validate([
            'order_id' => 'required|unique:data_laundry,order_id,' . $laundry->id,
            'customer_name' => 'required|string|max:255',
            'phone_number' => [
                'required',
                'string',
                'regex:/^(\+?\d{1,4}[\s-]?)?(\(?\d{2,4}\)?[\s-]?)?[\d\s-]{6,}$/',
                'min:10',
                'max:17',
            ],
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

        // Gabungkan shoe_merch dan shoe_color ke dalam satu kolom JSON
        // $shoePairs = [];
        $shoe_merch = $request->input('shoe_merch', []);
        $shoe_color = $request->input('shoe_color', []);
        foreach ($shoe_merch as $index => $merch) {
            $shoePairs[] = [
                'merch' => $merch,
                'color' => $shoe_color[$index] ?? ''
            ];
        }
        $validated['shoes'] = json_encode($request->input('shoes', []));

        // if ($request->working_status !== $laundry->working_status) {
        //     $validated['working_status_changed_at'] = now();

        //     // Jika diubah ke 'Finish', set order_finish juga
        //     if (strtolower($request->working_status) === 'finish') {
        //         $validated['order_finish'] = now();
        //     }
        // }

        // Jika working_status berubah dari selain "On Progress" ke "On Progress"
        if (
            $request->working_status !== $laundry->working_status &&
            strtolower($request->working_status) === 'on progress' &&
            strtolower($laundry->working_status) !== 'on progress'
        ) {
            $validated['working_status_changed_at'] = now();
        }

        // Jika working_status berubah dari selain "Finish" ke "Finish"
        if (
            $request->working_status !== $laundry->working_status &&
            strtolower($request->working_status) === 'finish' &&
            strtolower($laundry->working_status) !== 'finish'
        ) {
            $validated['order_finish'] = now();
        }




        // Handle gambar (jika ada)
        if ($request->hasFile('picture')) {
            if ($laundry->picture && Storage::disk('public')->exists($laundry->picture)) {
                Storage::disk('public')->delete($laundry->picture);
            }
            $validated['picture'] = $request->file('picture')->store('laundry_images', 'public');
        }

        $laundry->update($validated);

        return redirect()->route('laundry')->with('success', 'Order successfully updated!');
    }

    // public function update(Request $request, string $id)
    // {
    //     $laundry = Laundry::findOrFail($id);

    //     // Bersihkan format harga sebelum validasi
    //     $request->merge([
    //         'price' => preg_replace('/[^0-9]/', '', $request->price),
    //     ]);

    //     $validated = $request->validate([
    //         'order_id' => 'required|unique:data_laundry,order_id,' . $laundry->id,
    //         'customer_name' => 'required|string|max:255',
    //         'phone_number' => [
    //             'required',
    //             'string',
    //             'regex:/^(\+?\d{1,4}[\s-]?)?(\(?\d{2,4}\)?[\s-]?)?[\d\s-]{6,}$/',
    //             'min:10',
    //             'max:17',
    //         ],
    //         'service' => 'required',
    //         'price' => 'required|numeric',
    //         'note' => 'nullable|string',
    //         'payment_method' => 'required',
    //         'payment_status' => 'required',
    //         'working_status' => 'required',
    //         'order_start' => 'required|date',
    //         'estimated' => 'required|date',
    //         'order_finish' => 'nullable|date',
    //         'address' => 'required'
    //     ]);

    //     // Gabungkan shoe_merch dan shoe_color ke dalam satu kolom JSON
    //     $shoePairs = [];
    //     $shoe_merch = $request->input('shoe_merch', []);
    //     $shoe_color = $request->input('shoe_color', []);
    //     foreach ($shoe_merch as $index => $merch) {
    //         $shoePairs[] = [
    //             'merch' => $merch,
    //             'color' => $shoe_color[$index] ?? ''
    //         ];
    //     }
    //     $validated['shoes'] = json_encode($shoePairs);

    //     // Cek apakah working_status berubah
    //     if ($request->working_status !== $laundry->working_status) {
    //         $validated['working_status_changed_at'] = now();

    //         // Jika diubah ke 'Finish', set order_finish juga
    //         if (strtolower($request->working_status) === 'finish') {
    //             $validated['order_finish'] = now();
    //         }
    //     }


    //     // Handle gambar (jika ada)
    //     if ($request->hasFile('picture')) {
    //         if ($laundry->picture && Storage::disk('public')->exists($laundry->picture)) {
    //             Storage::disk('public')->delete($laundry->picture);
    //         }
    //         $validated['picture'] = $request->file('picture')->store('laundry_images', 'public');
    //     }

    //     $laundry->update($validated);

    //     return redirect()->route('laundry')->with('success', 'Order successfully updated!');
    // }

    public function destroy(string $id)
    {
        $laundry = Laundry::findOrFail($id);

        if ($laundry->picture && Storage::disk('public')->exists($laundry->picture)) {
            Storage::disk('public')->delete($laundry->picture);
        }

        $laundry->delete();
        return redirect()->route('laundry')->with('success', 'Orderan berhasil dihapus.');
    }
}