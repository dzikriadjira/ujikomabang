<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'full_name',
        'description',
        'image',
        'color',
        'competencies',
        'careers',
        'icon',
        'is_featured',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'competencies' => 'array',
        'careers' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scope for featured jurusan
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope for active jurusan
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
