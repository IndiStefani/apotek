<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use App\Models\Penjualan;

class PenjualanController extends Controller
{
    // Display a list of penjualan
    public function index()
    {
        $penjualanList = Penjualan::all();
        return view('laporan.index', compact('penjualanList'));
    }

    // Show the form to add a new Penjualan record
    public function create()
    {
        // Fetch data you may need in the form, e.g., list of available barangs
        $penjualanList = Penjualan::all();

        return view('laporan.create', compact('penjualaList'));
    }

    // Handle the form submission to store a new Penjualan record
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'kd_transaksi' => 'required|string',
        ]);

        // Create a new Penjualan record
        Penjualan::create([
            'kd_transaksi' => $request->kd_transaksi,
        ]);

        // Redirect back with a success message or to any other desired location
        return redirect()->route('penjualan.index')->with('success', 'Penjualan record added successfully');
    }

    // Display the specified penjualan
    public function show(Penjualan $penjualan)
    {
        return view('laporan.show', compact('penjualan'));
    }

    // Show the form for editing the specified penjualan
    public function edit(Penjualan $penjualan)
    {
        // You can add any necessary data or logic here
        return view('laporan.edit', compact('penjualan'));
    }

    // Update the specified penjualan in the database
    public function update(Request $request, Penjualan $penjualan)
    {
        // Validation and updating logic goes here
    }

    // Remove the specified penjualan from the database
    public function destroy(Penjualan $penjualan)
    {
        // Deletion logic goes here
    }
}
