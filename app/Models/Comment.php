<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function blogPost()
    {
        // return $this->belongsTo(BlogPost::class, 'post_id', 'blog_post_id');
        return $this->belongsTo(BlogPost::class);
    }
}
