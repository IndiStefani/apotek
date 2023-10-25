<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Transaksi;
use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PublikController extends BaseController
{
    public function index()
    {
        $obat = Obat::all();
        $detail = Detail::all();
        $transaksi = Transaksi::all();
        return view('publik.index', compact('transaksi', 'detail', 'obat'));
    }

    public function create()
    {
        $transaksi = Transaksi::all();
        $obat = Obat::all();
        return view('publik.create', compact('transaksi', 'obat',));
    }

    // Menyimpan data transaksi dan detail
    public function store(Request $request)
    {
        $request->validate([
            'kd_transaksi' => 'required',
            'nm_klien' => 'required',
            'total_harga' => 'required',
            'details.*transaksi_id' => 'required',
            'details.*.nm_obat' => 'required',
            'details.*.qty' => 'required',
            'details.*.sub_total' => 'required',
        ]);

        $details = $request->input('details');
        foreach ($details as $detailData) {
            $obat = Obat::where('nm_obat', $detailData['nm_obat'])->first();
            // Pastikan obat ditemukan sebelum melanjutkan
            if ($obat) {
                // Lakukan pengecekan jumlah stok di sini
                if ($obat->stok < $detailData['qty']) {
                    // Jika stok kurang dari jumlah yang dipesan, berikan pesan kesalahan
                    return redirect()->back()->with('error', 'Stok obat ' . $obat->nm_obat . ' tidak mencukupi.');
                }
            }
        }

        // Simpan transaksi
        $transaksi = Transaksi::create([
            'kd_transaksi' => $request->input('kd_transaksi'),
            'nm_klien' => $request->input('nm_klien'),
            'total_harga' => $request->input('total_harga'),
        ]);

        // Simpan detail transaksi
        foreach ($details as $detailData) {
            $obat = Obat::where('nm_obat', $detailData['nm_obat'])->first();

            // Kurangi stok obat
            $obat->stok -= $detailData['qty'];
            $obat->save();

            Detail::create([
                'transaksi_id' => $transaksi->id,
                'nm_obat' => $detailData['nm_obat'],
                'qty' => $detailData['qty'],
                'sub_total' => $detailData['sub_total'],
            ]);
        }

        // Redirect atau lakukan tindakan sesuai kebutuhan
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }
}
