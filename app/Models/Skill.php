<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill_category_id',
        'name',
        'level',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function skillCategory(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class);
    }

    public function getLevelPercentageAttribute(): int
    {
        return (int) (($this->level / 5) * 100);
    }
}
