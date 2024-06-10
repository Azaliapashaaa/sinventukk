<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'barang';

    // Specify the attributes that are mass assignable
    protected $fillable = ['merk', 'seri', 'spesifikasi', 'stok', 'kategori_id'];

    // Define the relationship to the Kategori model
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
