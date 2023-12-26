<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderByDesc('created_at');
    }

    /**
     * Get the blog that owns the post.
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     * Get all of the images for the post.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
