<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // deleting models with foreign key or reference events
    public static function boot()
    {
        parent::boot();

        // this is a method you can use for deleting.....
        static::deleting(function (BlogPost $blogPost) {
            $blogPost->comments()->delete();
        });

        // restoring a blog post
        static::restoring(function (BlogPost $blogPost) {
            $blogPost->comments()->restore();
        });
    }

    use HasFactory;
}
