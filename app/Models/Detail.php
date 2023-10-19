<?php

// app/Models/Detail.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'tb_detail'; // Adjust the table name if needed
    protected $primaryKey = "id";
    protected $fillable = [
        'transaksi_id',
        'nm_obat',
        'qty',
        'sub_total',
    ];


    // Define relationships
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
