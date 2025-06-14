<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $permintaanPerTahun = $this->faker->numberBetween(100, 5000);
        $biayaPemesanan = $this->faker->numberBetween(10000, 100000);
        $biayaPenyimpanan = $this->faker->numberBetween(1000, 10000);
        $penggunaanHarianRata2 = $this->faker->numberBetween(1, 50);
        $penggunaanHarianMaks = $this->faker->numberBetween(10, 100);
        $leadTime = $this->faker->numberBetween(1, 14);
        $leadTimeMaks = $this->faker->numberBetween(7, 21);

        // Perhitungan EOQ: √((2 × D × S) / H)
        $eoq = sqrt((2 * $permintaanPerTahun * $biayaPemesanan) / $biayaPenyimpanan);

        // Perhitungan Safety Stock: (Penggunaan Harian Maks × Lead Time Maks) - (Penggunaan Harian Rata-rata × Lead Time Rata-rata)
        $safetyStock = ($penggunaanHarianMaks * $leadTimeMaks) - ($penggunaanHarianRata2 * $leadTime);

        // Perhitungan ROP: (Penggunaan Harian Rata-rata × Lead Time) + Safety Stock
        $rop = ($penggunaanHarianRata2 * $leadTime) + $safetyStock;

        return [
            'kode' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'nama' => $this->faker->words(3, true),
            'satuan' => $this->faker->randomElement(['pcs', 'kg', 'liter', 'box']),
            'stok' => $this->faker->numberBetween(10, 1000),
            'rop' => max(0, round($rop)),
            'eoq' => max(1, round($eoq)),
            'safety_stock' => max(0, round($safetyStock)),
            'lead_time' => $leadTime,
            'permintaan_per_tahun' => $permintaanPerTahun,
            'biaya_pemesanan' => $biayaPemesanan,
            'biaya_penyimpanan' => $biayaPenyimpanan,
            'penggunaan_harian_rata2' => $penggunaanHarianRata2,
            'penggunaan_harian_maks' => $penggunaanHarianMaks,
            'lead_time_maks' => $leadTimeMaks,
        ];
    }
}
