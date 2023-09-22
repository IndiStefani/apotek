<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = "tb_obat"; // Set the table name
    protected $primaryKey = "id";
    protected $fillable = [
        'poster',
        'nm_obat',
        'kategori_id',
        'stok',
        'harga',
        'detail_id',
        'created_at',
        'update_at',
        // Kolom-kolom lain yang dapat diisi secara massal
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
