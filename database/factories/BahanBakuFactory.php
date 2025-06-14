<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BahanBaku>
 */
class BahanBakuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $permintaanPerTahun = $this->faker->numberBetween(100, 10000);
        $biayaPemesanan = $this->faker->randomFloat(2, 10, 500);
        $biayaPenyimpanan = $this->faker->randomFloat(2, 1, 50);
        $leadTime = $this->faker->numberBetween(1, 30);
        $leadTimeMaks = $this->faker->numberBetween(1, 60);
        $penggunaanHarianRata2 = $this->faker->numberBetween(1, 100);
        $penggunaanHarianMaks = $this->faker->numberBetween(1, 200);

        // Rumus EOQ = sqrt((2 * D * S) / H)
        // D = Permintaan per tahun, S = Biaya pemesanan, H = Biaya penyimpanan
        $eoq = sqrt((2 * $permintaanPerTahun * $biayaPemesanan) / $biayaPenyimpanan);

        // Rumus ROP = (Penggunaan harian rata-rata * Lead time)
        $rop = $penggunaanHarianRata2 * $leadTime;

        // Rumus Safety Stock = (Penggunaan harian maksimum * Lead time maksimum) - (Penggunaan harian rata-rata * Lead time)
        $safetyStock = ($penggunaanHarianMaks * $leadTimeMaks) - ($penggunaanHarianRata2 * $leadTime);

        return [
            'kode' => $this->faker->unique()->bothify('BB-###'),
            'nama' => $this->faker->word(),
            'satuan' => $this->faker->randomElement(['kg', 'liter', 'pcs']),
            'stok' => $this->faker->numberBetween(0, 1000),
            'permintaan_per_tahun' => $permintaanPerTahun,
            'biaya_pemesanan' => $biayaPemesanan,
            'biaya_penyimpanan' => $biayaPenyimpanan,
            'lead_time' => $leadTime,
            'lead_time_maks' => $leadTimeMaks,
            'penggunaan_harian_rata2' => $penggunaanHarianRata2,
            'penggunaan_harian_maks' => $penggunaanHarianMaks,
            'eoq' => round($eoq, 2),
            'rop' => round($rop, 2),
            'safety_stock' => round($safetyStock, 2),
        ];
    }
}
