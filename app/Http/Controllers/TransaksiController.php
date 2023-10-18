<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Obat;
use App\Models\Detail;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Display a list of penjualan
    public function index()
    {
        $detail = Detail::all();
        $transaksi = Transaksi::all();
        return view('transaksi.index', compact('transaksi', 'detail'));
    }

    // Show the form to add a new Penjualan record
    // Show the form for creating a new obat
    public function create()
    {
        $transaksi = Transaksi::all();
        $obat = Obat::all();
        return view('transaksi.create', compact('transaksi', 'obat',));
    }

    // Menyimpan data transaksi dan detail
    public function store(Request $request)
    {
        dd($request);
    }
}
