<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "tb_kategori";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'nm_kategori'];
    
    public function obat()
    {
        return $this -> hasMany(Obat::class);
    }
}
