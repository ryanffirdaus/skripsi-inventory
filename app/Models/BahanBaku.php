<?php

namespace App\Models;

use App\Notifications\BahanBakuNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BahanBaku extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'bahan_baku';

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
