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
        return view('admin.index', compact('obatList'));
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
        // Validate the form data
        $validatedData = $request->validate([
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the image validation rules as needed
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|string|max:255',
            'jumlah' => 'required|numeric|max:255',
            'harga' => 'required|numeric|max:255',
            // Add validation rules for other obat properties here
        ]);

        // Handle image upload
        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $namaPoster = time() . '.' . $poster->getClientOriginalExtension();
            $poster->move(public_path('image'), $namaPoster); // Store the uploaded image in the 'storage/app/public/obat_images' directory
        } else {
            $poster = null; // No image uploaded
        }

        // Create a new obat record
        $obat = new Obat;
        $obat->poster = $namaPoster; // Store the image path in the 'poster' column
        $obat->nama = $validatedData['nama'];
        $obat->deskripsi = $validatedData['deskripi'];
        $obat->kategori_id = $validatedData['kategori_id'];
        $obat->jumlah = $validatedData['jumlah'];
        $obat->harga = $validatedData['harga'];
        // Set other obat properties here
        $obat->save();

        // Redirect back to the obat index page with a success message
        return redirect()->route('super.superobat')->with('success', 'Obat berhasil ditambahkan');
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
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|string|max:255',
            'jumlah' => 'required|numeric|max:255',
            'harga' => 'required|numeric|max:255',
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
