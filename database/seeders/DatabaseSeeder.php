<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AnalysisPrice;
use App\Models\AnalysisPriceStatus;
use App\Models\GroupCustomer;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AnalysisPriceStatus::insert([
            [
                'name' => 'Chờ duyệt',
                'value' => 'wait',
                'class_color' => 'bg-warning'
            ],
            [
                'name' => 'Đã duyệt',
                'value' => 'approve',
                'class_color' => 'bg-success'
            ], [
                'name' => 'Từ chối',
                'value' => 'reject',
                'class_color' => 'bg-danger'
            ],
        ]);

        GroupCustomer::factory(10)
            ->has(
                User::factory(50)
                    ->has(AnalysisPrice::factory(10))
            )
            ->create();

        // AnalysisPrice::factory(100)
        //     ->has(
        //         User::factory(100)
        //             ->has(GroupCustomer::factory(100))

        //     );
    }
}
