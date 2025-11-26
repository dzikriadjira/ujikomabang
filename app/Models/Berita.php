<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'image',
        'author',
        'published_at',
        'is_active'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    public function getShortExcerptAttribute()
    {
        return substr($this->excerpt ?: strip_tags($this->content), 0, 100) . '...';
    }

    public function getFormattedDateAttribute()
    {
        return $this->published_at->format('d M Y');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }
}
