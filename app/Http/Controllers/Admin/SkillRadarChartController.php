<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkillRadarChart;
use Illuminate\Http\Request;

class SkillRadarChartController extends Controller
{
    public function index()
    {
        $radarChart = SkillRadarChart::where('is_active', true)->first();

        if (!$radarChart) {
            $radarChart = SkillRadarChart::create([
                'frontend_level' => 0,
                'backend_level' => 0,
                'infrastructure_level' => 0,
                'ai_level' => 0,
                'tools_level' => 0,
                'is_active' => true,
            ]);
        }

        return view('admin.skill-radar-chart.index', compact('radarChart'));
    }

    public function update(Request $request, $radarChartId)
    {
        $radarChart = SkillRadarChart::findOrFail($radarChartId);

        $request->validate([
            'frontend_level' => 'required|integer|min:0|max:5',
            'backend_level' => 'required|integer|min:0|max:5',
            'infrastructure_level' => 'required|integer|min:0|max:5',
            'ai_level' => 'required|integer|min:0|max:5',
            'tools_level' => 'required|integer|min:0|max:5',
        ]);

        $radarChart->update($request->all());

        // キャッシュをクリア
        cache()->forget('radar_chart_data');

        return redirect()->route('admin.skill-radar-chart.index')
            ->with('success', 'レーダーチャートが更新されました。');
    }
}
