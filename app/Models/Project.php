<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'long_description',
        'category',
        'tech_stack',
        'live_url',
        'github_url',
        'image',
        'featured',
        'status',
        'completed_at',
        'sort_order',
    ];

    protected $casts = [
        'featured'     => 'boolean',
        'completed_at' => 'date',
    ];

    // Auto-generate slug from title before creating
    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title) . '-' . Str::random(4);
            }
        });
    }

    public function getTechArrayAttribute(): array
    {
        return array_map('trim', explode(',', $this->tech_stack));
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
