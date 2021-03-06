<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters) {
        // $query->when($filters['search'] ?? false, function ($query, $search) {
        //     $query
        //         ->where('title', 'like', '%' . $search . '%')
        //         ->orWhere('body', 'like', '%' . $search . '%');
        // });
        $query->when($filters['search'] ?? false, fn ($query, $search) => // PHP 8 with arrow functions
            $query->where(fn ($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            )
        );
        
        $query->when($filters['category'] ?? false, fn ($query, $category) => // PHP 8 with arrow functions
            $query
                // ->whereExists(fn ($query) =>
                //     $query->from('categories')
                //         ->whereColumn('categories.id', 'posts.category_id')
                //         ->where('categories.slug', $category)
                // )
                ->whereHas('category', fn ($query) => // Much cleaner than whereExists()
                    $query->where('slug', $category)
                )
        );

        $query->when($filters['author'] ?? false, fn ($query, $author) => 
            $query
                ->whereHas('author', fn ($query) =>
                    $query->where('username', $author)
                )
        );
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        # hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
