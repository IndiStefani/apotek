<?php

// Transaksi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tb_transaksi'; // Tentukan nama tabel
    protected $primaryKey = 'id'; // Tentukan kolom kunci utama

    protected $fillable = [
        'kd_transaksi',
        'nm_klien',
        'alamat',
        'telp',
        'total_harga',
    ];

    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
