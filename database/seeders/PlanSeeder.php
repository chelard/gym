<?php

namespace Database\Seeders;

use App\Enums\PlanType;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'Mensual',
            'type' => PlanType::Tiempo,
            'days_duration' => 30,
            'price' => 100,
            'freeze_days' => 10,
        ]);

        Plan::create([
            'name' => 'Trimestral',
            'type' => PlanType::Tiempo,
            'days_duration' => 90,
            'price' => 250,
            'freeze_days' => 30,
        ]);

        Plan::create([
            'name' => 'Semestral',
            'type' => PlanType::Tiempo,
            'days_duration' => 180,
            'price' => 350,
            'freeze_days' => 60,
        ]);

        Plan::create([
            'name' => 'Anual',
            'type' => PlanType::Tiempo,
            'days_duration' => 365,
            'price' => 500,
            'freeze_days' => 90,
        ]);

        Plan::create([
            'name' => 'Libre 30 días',
            'type' => PlanType::Tiempo,
            'days_duration' => 30,
            'price' => 150,
            'freeze_days' => 0,
        ]);

//        Plan::factory()
//            ->count(10)
//            ->create();
    }
}
