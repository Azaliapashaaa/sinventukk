<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = ['deskripsi', 'kategori'];

    public static function getKategoriAll()
    {
        return DB::table('kategori')
            ->select('kategori.id', 'deskripsi')
            ->selectRaw('CASE 
                            WHEN kategori = "M" THEN "Barang Modal"
                            WHEN kategori = "A" THEN "Alat"
                            WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
                            WHEN kategori = "BTHP" THEN "Bahan Tidak Habis Pakai"
                            ELSE "Unknown"
                       END as ketkategorik');
    }
}
