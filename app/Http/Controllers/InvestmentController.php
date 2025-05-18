<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\Investment;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $investment = Investment::paginate(10);
        $totalInvest = Investment::sum('invest'); // Hitung total invest
        return view('investment.index', compact('investment', 'totalInvest'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('investment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'invest' => preg_replace('/[^0-9]/', '', $request->invest),
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_invest' => 'required|date',
            'invest' => 'required|numeric|min:0',

        ]);
        Investment::create($validated);
        return redirect()->route('investment')->with('success', 'Data Invest berhasil disimpan.');

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
        $investment = Investment::findOrFail($id);
        return view('investment.edit', compact('investment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge([
            'invest' => preg_replace('/[^0-9]/', '', $request->invest),
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_invest' => 'required|date',
            'invest' => 'required|numeric|min:0',
        ]);

        $investment = Investment::findOrFail($id);
        $investment->update($validated);

        return redirect()->route('investment')->with('success', 'Data Invest berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $investment = Investment::findOrFail($id);
        $investment->delete();

        return redirect()->route('investment')->with('success', 'Data Invest berhasil dihapus.');
    }
}