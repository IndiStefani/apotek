<?php
  
namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\obat;
use App\Models\Transaksi;
use App\Models\user; 
  
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
     public function admin(): View
    {
        $obat = Obat::all();
        return view('admin.dashboard', compact('obat'));
    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function super(): View
    {
        $totalUsers = User::count();
        $totalObats = Obat::count();
        $totalTransaksis = Transaksi::count();
        $totalKategoris = Kategori::count();

        return view('super.dashboard', compact('totalUsers', 'totalObats', 'totalTransaksis', 'totalKategoris'));
    }
}