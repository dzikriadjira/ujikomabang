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

    public function getImageUrlAttribute()
    {
        $path = $this->image;
        if (!empty($path)) {
            $storageReal = storage_path('app/public/' . ltrim($path, '/'));
            if (file_exists($storageReal)) {
                return '/storage/' . ltrim($path, '/');
            }
            if (file_exists(public_path($path))) {
                return '/' . ltrim($path, '/');
            }
        }

        $id = strtolower(str_replace(' ', '', $this->name ?? ''));
        $conventional = 'images/jurusan/' . $id . '.png';
        if ($id && file_exists(public_path($conventional))) {
            return '/' . ltrim($conventional, '/');
        }

        if (file_exists(public_path('images/lg_pplg-removebg-preview.png'))) {
            return '/images/lg_pplg-removebg-preview.png';
        }

        return null;
    }
}
