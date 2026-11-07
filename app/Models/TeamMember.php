<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'role',
        'short_bio',
        'biography',
        'email',
        'phone',
        'location',
        'linkedin_url',
        'github_url',
        'facebook_url',
        'website_url',
        'skills',
        'experience',
        'education',
        'certifications',
        'languages',
        'profile_photo_path',
        'cv_file_path',
        'is_sample',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_sample' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
