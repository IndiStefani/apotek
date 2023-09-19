<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postimage;
use App\Models\Obat; // Make sure to import the Obat model

class ObatController extends Controller
{
    // Display a list of obat for Admin
    public function indexAdmin()
    {
        $obatList = Obat::all();
        return view('admin.obat.index', compact('obatList'));
    }

    // Show the form for creating a new obat
    public function create()
    {
        return view('super.create');
    }

    // Store a newly created obat in the database
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the image validation rules as needed
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|numeric|max:255',
            'harga' => 'required|numeric|max:255',
            // Add validation rules for other obat properties here
        ]);

        // Handle image upload
        if ($request->hasFile('poster')) {
            $poster = $request -> file('poster');
            $namaPoster = time() . '.' . $poster -> getClientOriginalExtension();
            $poster -> move(public_path('image'), $namaPoster); // Store the uploaded image in the 'storage/app/public/obat_images' directory
        } else {
            $poster = null; // No image uploaded
        }

        // Create a new obat record
        $obat = new Obat;
        $obat->poster = $namaPoster; // Store the image path in the 'poster' column
        $obat->nama = $validatedData['nama'];
        $obat->kategori = $validatedData['kategori'];
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
        return view('admin.obat.edit', compact('obat'));
    }

    // Update the specified obat in the database
    public function update(Request $request, Obat $obat)
    {
        $validatedData = $request->validate([
            'Poster' => 'required',
            'Nama' => 'required',
            'Kategori' => 'required',
            'Jumlah' => 'required|numeric',
            'Harga' => 'required|numeric',
            // Add validation rules for other columns as needed
        ]);

        $obat->update($validatedData);

        return redirect()->route('adminobat.index')
            ->with('success', 'Obat updated successfully');
    }

    // Remove the specified obat from the database
    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('adminobat.index')
            ->with('success', 'Obat deleted successfully');
    }

    // Display a list of obat for Super Admin
    public function indexSuper()
    {
        $obatList = Obat::all();
        return view('super.superobat', compact('obatList'));
    }

    // Add more methods as needed for Super Admin-specific functionality

    /*You've to use the database model name from your App\Models folder at the top of
 your controller page*/


    //Store image
    public function storeImage(Request $request)
    {
        $data = new Postimage();

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/Image'), $filename);
            $data['image'] = $filename;
        }
        $data->save();
        return redirect()->route('images.view');
    }

    //View post
    public function viewImage()
    {
        $imageData = Postimage::all();
        return view('Image.view_image', compact('imageData'));
    }
}
