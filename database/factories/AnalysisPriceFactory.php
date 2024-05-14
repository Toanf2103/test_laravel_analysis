<?php

namespace Database\Factories;

use App\Models\AnalysisPriceStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnalysisPrice>
 */
class AnalysisPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => 1,
            'name' => 'Phân tích ' . fake()->name(),
            'status_id' => AnalysisPriceStatus::select('id')->inRandomOrder()->first(),
            'quantity' => rand(1, 20),
            'amount' => rand(20, 100) * 10000
        ];
    }
}
