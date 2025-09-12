<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function activeSkills(): HasMany
    {
        return $this->hasMany(Skill::class)->where('is_active', true)->orderBy('sort_order');
    }
}
