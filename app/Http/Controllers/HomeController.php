<?php
  
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\obat;
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
        return view('admin.adminhome', compact('obat'));
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

        return view('super.superhome', compact('totalUsers', 'totalObats'));
    }
  
}