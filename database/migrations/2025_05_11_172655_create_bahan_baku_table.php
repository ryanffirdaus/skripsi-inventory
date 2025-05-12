<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_bahan_baku_table.php

    public function up()
    {
        Schema::create('bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->string('satuan');
            $table->integer('stok')->default(0);
            $table->integer('rop')->nullable(); // reorder point
            $table->integer('eoq')->nullable(); // EOQ
            $table->float('safety_stock')->nullable();
            $table->integer('lead_time')->nullable(); // hari
            $table->integer('permintaan_per_tahun')->nullable();
            $table->float('biaya_pemesanan')->nullable();
            $table->float('biaya_penyimpanan')->nullable();
            $table->float('penggunaan_harian_rata2')->nullable();
            $table->float('penggunaan_harian_maks')->nullable();
            $table->integer('lead_time_maks')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_baku');
    }
};
