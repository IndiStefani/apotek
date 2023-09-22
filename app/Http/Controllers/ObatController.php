<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat; // Make sure to import the Obat model
use App\Models\Kategori;

class ObatController extends Controller
{
    // Display a list of obat for Admin
    public function indexAdmin()
    {
        $obatList = Obat::all();
        return view('admin.dashboard', compact('obatList'));
    }

    // Show the form for creating a new obat
    public function create()
    {
        $kategoriList = Kategori::all();
        return view('super.create', compact('kategoriList'));
        $obatList = Obat::all();
        return view('super.create', compact('obatList'));
    }

    // Store a newly created obat in the database
    public function store(Request $request)
    {
        dd($request);
    }

    // Display the specified obat for editing (Admin)
    public function edit(Obat $obat)
    {
        $kategoriList = Kategori::all();
        return view('super.update', compact('obat', 'kategoriList'));
    }

    // Update the specified obat in the database
    public function update(Request $request, Obat $obat)
    {
        $validatedData = $request->validate([
            'poster' => 'required|string|max:255',
            'nm_obat' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
            // Add validation rules for other obat properties here
        ]);

        $obat->update($validatedData);

        return redirect()->route('super.superobat')
            ->with('success', 'Obat updated successfully');
    }


    // Remove the specified obat from the database
    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('super.superobat')
            ->with('success', 'Obat deleted successfully');
    }

    // Display a list of obat for Super Admin
    public function indexSuper()
    {
        $obatList = Obat::with('kategori')->get();
        return view('super.superobat', compact('obatList'));
    }
}
