<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillRadarChart extends Model
{
    use HasFactory;

    protected $table = 'skill_radar_chart';

    protected $fillable = [
        'frontend_level',
        'backend_level',
        'infrastructure_level',
        'ai_level',
        'tools_level',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * ルートモデルバインディングのキー名を取得
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * レーダーチャート用のデータを取得
     */
    public function getRadarData(): array
    {
        return [
            'frontend' => $this->frontend_level,
            'backend' => $this->backend_level,
            'infrastructure' => $this->infrastructure_level,
            'ai' => $this->ai_level,
            'tools' => $this->tools_level,
        ];
    }
}
