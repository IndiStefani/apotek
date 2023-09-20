<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = "obats";
    protected $primaryKey = "id";
    protected $fillable = [
        'poster',
        'nama', // Tambahkan 'nama' ke dalam daftar ini
        'deskripsi',
        'kategori_id',
        'jumlah',
        'harga',
        // Kolom-kolom lain yang dapat diisi secara massal
    ];
    
    public function kategori()
    {
        return $this -> belongsTo(Kategori::class);
    }
}
