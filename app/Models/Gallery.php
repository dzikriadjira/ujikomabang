<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'thumbnail',
        'category_id',
        'user_id',
        'location',
        'event_date',
        'is_featured',
        'is_active',
        'views',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the category that owns the gallery
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Tanpa Kategori',
            'color' => '#9CA3AF',
        ]);
    }

    /**
     * Get the user that created the gallery
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all likes for the gallery
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get all dislikes for the gallery
     */
    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    /**
     * Get all comments for the gallery
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->with('user', 'replies');
    }

    /**
     * Get the likes count for the gallery
     */
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    /**
     * Get the dislikes count for the gallery
     */
    public function getDislikesCountAttribute()
    {
        return $this->dislikes()->count();
    }

    /**
     * Get the comments count for the gallery
     */
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    /**
     * Check if a user has liked the gallery
     */
    public function isLikedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Check if a user has disliked the gallery
     */
    public function isDislikedByUser($userId)
    {
        return $this->dislikes()->where('user_id', $userId)->exists();
    }

    /**
     * Scope for active galleries
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured galleries
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Increment view count
     */
    public function incrementViews()
    {
        $this->increment('views');
    }
}
