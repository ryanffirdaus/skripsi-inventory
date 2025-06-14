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

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($bahanBaku) {
            // Hitung EOQ
            if ($bahanBaku->permintaan_per_tahun && $bahanBaku->biaya_pemesanan && $bahanBaku->biaya_penyimpanan) {
                $bahanBaku->eoq = round(sqrt((2 * $bahanBaku->permintaan_per_tahun * $bahanBaku->biaya_pemesanan) / $bahanBaku->biaya_penyimpanan));
            }

            // Hitung Safety Stock
            if ($bahanBaku->penggunaan_harian_maks && $bahanBaku->lead_time_maks && $bahanBaku->penggunaan_harian_rata2 && $bahanBaku->lead_time) {
                $bahanBaku->safety_stock = round(($bahanBaku->penggunaan_harian_maks * $bahanBaku->lead_time_maks) - ($bahanBaku->penggunaan_harian_rata2 * $bahanBaku->lead_time));
            }

            // Hitung ROP
            if ($bahanBaku->penggunaan_harian_rata2 && $bahanBaku->lead_time) {
                $bahanBaku->rop = round(($bahanBaku->penggunaan_harian_rata2 * $bahanBaku->lead_time) + $bahanBaku->safety_stock);
            }
        });

        static::saved(function ($bahanBaku) {
            session()->flash('success', 'Perhitungan EOQ, Safety Stock, dan ROP berhasil dilakukan!');
            $bahanBaku->notify(new BahanBakuNotification($bahanBaku));
        });
    }
}
