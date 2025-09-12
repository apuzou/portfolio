<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\SkillRadarChart;
use Illuminate\Database\Seeder;

class SkillRadarChartSeeder extends Seeder
{
    public function run(): void
    {
        SkillRadarChart::create([
            'frontend_level' => 4,
            'backend_level' => 5,
            'infrastructure_level' => 3,
            'ai_level' => 2,
            'tools_level' => 4,
            'is_active' => true,
        ]);
    }
}
