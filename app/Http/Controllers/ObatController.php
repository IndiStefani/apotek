<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Obat;
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


    public function store(Request $request)
    {
        $request->validate([
            'poster' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048|nullable',
            'nm_obat' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $namaposter = time() . '.' . $poster->getClientOriginalExtension();
            $poster->move(public_path('image'), $namaposter); // Simpan poster di direktori publik
        } else {
            $namaposter = null; // Jika tidak ada poster yang diunggah
        }

        Obat::create([
            'poster' => $namaposter,
            'nm_obat' => $request->input('nm_obat'),
            'kategori_id' => $request->input('kategori_id'),
            'stok' => $request->input('stok'),
            'harga' => $request->input('harga'),
        ]);

        if (Auth::user()->Super()) {
            return redirect()->route('super.superobat')->with('success', 'Obat telah ditambahkan.');
        } else {
            return redirect()->route('admin.dashboard')->with('success', 'Obat telah ditambahkan.');
        }
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
            'nm_obat' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            // Add validation rules for other obat properties here
        ]);

        $obat->update($validatedData);

        return redirect()->route('super.superobat')
            ->with('success', 'Obat updated successfully');
    }


    // Remove the specified obat from the database
    public function destroy(Obat $obat)
    {
        // Check if the obat has a poster (image)
        if ($obat->poster) {
            $namaposter = public_path('image/' . $obat->poster);

            if (File::exists($namaposter)) {
                File::delete($namaposter);
            }
        }

        // Delete the obat record from the database
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

    public function obatData()
    {
        $obatData = Obat::all();
        return response()->json($obatData);
    }
}
