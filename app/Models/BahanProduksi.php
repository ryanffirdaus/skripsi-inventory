<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BahanProduksi extends Model
{
    use HasFactory, SoftDeletes;
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
