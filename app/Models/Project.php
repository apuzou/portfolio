<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'featured_image',
        'demo_url',
        'github_url',
        'start_date',
        'end_date',
        'status',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProjectCategory::class, 'project_category_pivot');
    }

    public function technologies(): HasMany
    {
        return $this->hasMany(ProjectTechnology::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
