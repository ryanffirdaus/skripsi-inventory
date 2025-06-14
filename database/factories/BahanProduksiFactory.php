<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BahanProduksi>
 */
class BahanProduksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'produk_id' => $this->faker->numberBetween(1, 10),
            'bahan_baku_id' => $this->faker->numberBetween(1, 10),
            'jumlah' => $this->faker->numberBetween(1, 100),
            'satuan' => $this->faker->randomElement(['kg', 'gram', 'liter', 'ml', 'pcs']),
        ];
    }
}
