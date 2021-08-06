<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\File;

class Post
{
    public $title;

    public $excerpt;

    public $date;

    public $body;

    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all() {
        // $files = File::files(resource_path("posts/"));

        // return array_map(fn($file) => $file->getContents(), $files);

        return cache()->rememberForever('posts.all', function () {
            return collect(File::files(resource_path("posts"))) 
            ->map(fn($file) => YamlFrontMatter::parseFile($file))
            ->map(fn($document) => new Post (
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            ))
            ->sortByDesc('date');
        });

        // return array_map(function ($file) {
        //     return $file->getContents();
        // }, $files); // Pre php7.4 function
    }

    public static function find($slug) {

        // Of all the blog posts, find the one with a slug that matches the one that was requested.

        // $posts = static::all(); no longer needed as inline

        return static::all()->firstWhere('slug', $slug);

        // base_path(); // Path to you the base of your application.

        // if (! file_exists($path = resource_path("posts/{$slug}.html"))) {
        //     // return redirect('/');
        //     throw new ModelNotFoundException();
        // // abort(404); // To make a 404 not found page apear (built into Laravel)
        // }

        // return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path)); // You can use now()->addMinute(1) or now()->addHour(1) or now()->AddDay(1) etc. instead of 1200 (seconds)
    }
}