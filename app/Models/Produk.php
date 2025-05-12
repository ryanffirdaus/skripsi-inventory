<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
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
