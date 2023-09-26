<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    // Display a list of penjualan
    public function index()
    {
        $transaksiList = Obat::all();
        return view('transaksi.index', compact('transaksiList'));
    }

    // Show the form to add a new Penjualan record
    public function create()
    {
        // Fetch data you may need in the form, e.g., list of available barangs
        $transaksiList = Obat::all();

        return view('laporan.create', compact('transaksiList'));
    }

    // Display the specified penjualan
    public function show(Obat $obat)
    {
        return view('transaksi.show', compact('transaksi'));
    }
}
