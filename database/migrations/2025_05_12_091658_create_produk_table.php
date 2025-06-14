<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->string('satuan');
            $table->integer('stok')->default(0);
            $table->integer('rop')->nullable(); // reorder point
            $table->integer('eoq')->nullable();
            $table->integer('safety_stock')->nullable();
            $table->integer('lead_time')->nullable();
            $table->integer('permintaan_per_tahun')->nullable();
            $table->integer('biaya_pemesanan')->nullable();
            $table->integer('biaya_penyimpanan')->nullable();
            $table->integer('penggunaan_harian_rata2')->nullable();
            $table->integer('penggunaan_harian_maks')->nullable();
            $table->integer('lead_time_maks')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
