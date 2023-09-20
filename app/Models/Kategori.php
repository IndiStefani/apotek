<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = "kategori";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'nm_kategori'];
    
    public function obat()
    {
        return $this -> hasMany(Obat::class);
    }
}
