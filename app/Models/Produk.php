<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'produk';

    protected $fillable = [
        'kode',
        'nama',
        'satuan',
        'stok',
        'rop', // reorder point
        'eoq',
        'safety_stock',
        'lead_time',
        'permintaan_per_tahun',
        'biaya_pemesanan',
        'biaya_penyimpanan',
        'penggunaan_harian_rata2',
        'penggunaan_harian_maks',
        'lead_time_maks',
    ];

    public function bahanProduksi()
    {
        return $this->hasMany(BahanProduksi::class);
    }
}
