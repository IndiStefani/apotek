<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Obat;
use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
        $request->validate([
            'kd_transaksi' => 'required',
            'nm_klien' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
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
            'alamat' => $request->input('alamat'),
            'telp' => $request->input('telp'),
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

    public function destroy($id)
    {
        // Hapus data pada tb_transaksi
        Detail::where('transaksi_id', $id)->delete();

        // Hapus data pada tb_transaksi
        Transaksi::find($id)->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }


    public function view($id)
    {
        $transaksi = Transaksi::find($id); // Gantilah dengan logika pengambilan data sesuai kebutuhan Anda.

        if (!$transaksi) {
            return abort(404); // Atau tampilkan halaman 404 jika tidak ditemukan
        }

        // Mengambil detail transaksi yang terkait dengan transaksi tersebut
        $details = $transaksi->details;
        return view('transaksi.view', compact('transaksi', 'details'));
    }
}
