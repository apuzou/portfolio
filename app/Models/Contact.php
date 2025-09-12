<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function replies(): HasMany
    {
        return $this->hasMany(ContactReply::class);
    }

    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('status', 'unread');
    }

    public function scopeRead(Builder $query): Builder
    {
        return $query->where('status', 'read');
    }

    public function scopeReplied(Builder $query): Builder
    {
        return $query->where('status', 'replied');
    }

    public function scopeArchived(Builder $query): Builder
    {
        return $query->where('status', 'archived');
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'unread' => '未読',
            'read' => '既読',
            'replied' => '返信済み',
            'archived' => 'アーカイブ',
            default => '不明',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'unread' => 'yellow',
            'read' => 'blue',
            'replied' => 'green',
            'archived' => 'gray',
            default => 'gray',
        };
    }
}
