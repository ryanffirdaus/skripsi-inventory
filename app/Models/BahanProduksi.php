<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanProduksi extends Model
{
    protected $table = 'bahan_produksi';

    protected $fillable = [
        'produk_id',
        'bahan_baku_id',
        'jumlah',
        'satuan',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
}
