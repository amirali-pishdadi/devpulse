<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Article extends Model implements Feedable
{
    use HasFactory;

    protected $fillable = [
        "title",
        "slug",
        "content",
        "excerpt",
        "status",
        "tags",
        "category_id",
        "author_id",
        "featured_image_url",
        "reading_time",
        "views_count",
        "likes_count",
        'is_pinned',

    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($article) {
            // Prepend the ID to the existing slug after the article is created
            $article->slug = $article->id . '-' . $article->slug;
            $article->save(); // Save the updated slug
        });
    }

    
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id'          => $this->id,
            'title'       => $this->title,
            'summary'     => $this->excerpt,
            'updated'     => $this->updated_at,
            
            'category' => $this->category->name,
            'link'        => route('articleShow', $this->slug),
            'authorName'  => $this->user->name,
            'authorEmail' => $this->user->email,

        ]);
    }

    public static function getFeedItems()
    {
        return Article::orderBy('created_at', 'desc')->get();

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
