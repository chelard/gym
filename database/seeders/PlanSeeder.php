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
            'price' => 120,
            'freeze_days' => 10,
        ]);

        Plan::create([
            'name' => '4 Meses',
            'type' => PlanType::Tiempo,
            'days_duration' => 90,
            'price' => 300,
            'freeze_days' => 30,
        ]);

        Plan::create([
            'name' => 'Semestral',
            'type' => PlanType::Tiempo,
            'days_duration' => 180,
            'price' => 400,
            'freeze_days' => 60,
        ]);

        Plan::create([
            'name' => 'Anual',
            'type' => PlanType::Tiempo,
            'days_duration' => 365,
            'price' => 600,
            'freeze_days' => 90,
        ]);

        Plan::create([
            'name' => 'Libre 30 días',
            'type' => PlanType::Tiempo,
            'days_duration' => 30,
            'price' => 150,
            'freeze_days' => 0,
        ]);

        Plan::create([
            'name' => 'Prueba 2 días',
            'type' => PlanType::Tiempo,
            'days_duration' => 2,
            'price' => 0,
            'freeze_days' => 0,
        ]);

//        Plan::factory()
//            ->count(10)
//            ->create();
    }
}
