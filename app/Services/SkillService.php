<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SkillRadarChart;

class SkillService
{
  public function getSkillCategoriesWithSkills()
  {
    return SkillCategory::where('is_active', true)
      ->with('activeSkills')
      ->orderBy('sort_order')
      ->get();
  }

  public function createSkill(array $data): Skill
  {
    return Skill::create($data);
  }

  public function updateSkill(Skill $skill, array $data): Skill
  {
    $skill->update($data);
    return $skill;
  }

  public function deleteSkill(Skill $skill): bool
  {
    return $skill->delete();
  }

  public function getRadarChartData()
  {
    return cache()->remember('radar_chart_data', 3600, function () {
      return SkillRadarChart::where('is_active', true)->first() ?? $this->createOrGetRadarChart();
    });
  }

  public function updateRadarChart(SkillRadarChart $radarChart, array $data): SkillRadarChart
  {
    $radarChart->update($data);

    // キャッシュをクリア
    cache()->forget('radar_chart_data');

    return $radarChart;
  }

  public function createOrGetRadarChart(): SkillRadarChart
  {
    return SkillRadarChart::firstOrCreate(
      ['is_active' => true],
      [
        'frontend_level' => 0,
        'backend_level' => 0,
        'infrastructure_level' => 0,
        'ai_level' => 0,
        'tools_level' => 0,
        'is_active' => true,
      ]
    );
  }
}
