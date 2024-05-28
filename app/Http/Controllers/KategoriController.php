<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // Display a list of obat for Admin
    public function indexKategori()
    {
        $kategoriList = Kategori::all();
        return view('super.indexKategori', compact('kategoriList'));
    }

    // Show the form for creating a new obat
    public function create()
    {
        $kategoriList = Kategori::all();
        return view('super.kategoriCreate', compact('kategoriList'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nm_kategori' => 'required|string|max:255',
            // Tambahkan aturan validasi lain jika diperlukan
        ]);

        Kategori::create($validatedData);

        return redirect()->route('super.indexKategori')->with('success', 'Kategori berhasil ditambahkan');
    }



    // Display the specified obat for editing (Admin)
    public function edit(Kategori $kategori)
    {
        $kategoriList = Kategori::all();
        return view('super.kategoriUpdate', compact('kategoriList'));
    }


    // Update the specified obat in the database
    public function update(Request $request, Kategori $kategori)
    {
    }


    // Remove the specified obat from the database
    public function destroy($id)
    {
        try {
            // Temukan kategori berdasarkan ID
            $kategori = Kategori::find($id);

            if (!$kategori) {
                return redirect()->route('super.indexKategori')->with('error', 'Kategori tidak ditemukan.');
            }

            // Lakukan penghapusan kategori
            $kategori->delete();

            return redirect()->route('super.indexKategori')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('super.indexKategori')->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
