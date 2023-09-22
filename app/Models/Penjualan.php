<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'tb_penjualan'; // Set the table name
    protected $fillable = [
        'kd_penjualan',
        'tgl_penjualan',
        'jumlah',  // Replace with your actual database columns
    ];

    // Define relationships (e.g., with Barang)
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Add any other methods or customization as needed
}
