<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['content', 'user_id', 'gallery_id', 'guest_name', 'parent_id'];
=======
    protected $fillable = ['content', 'user_id', 'gallery_id'];
>>>>>>> 40faa748db351c71c2c78aef2a8e8edac43a1828

    /**
     * Get the user that owns the comment
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the gallery that was commented on
     */
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }
<<<<<<< HEAD

    /**
     * Get the comment author name (user or guest)
     */
    public function getAuthorNameAttribute()
    {
        return $this->user ? $this->user->name : $this->guest_name;
    }

    /**
     * Get replies for this comment
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
=======
>>>>>>> 40faa748db351c71c2c78aef2a8e8edac43a1828
}
