<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // \Illuminate\Support\Facades\DB::listen(function ($query) { // Debugging SQL (long way) if not using Laravel PHP Clockwork.
    //     logger($query->sql, $query->bindings);
    // });



    return view('posts', [
        'posts' => Post::latest()->with(['category', 'author'])->get(),
        'categories' => Category::all()
    ]);
});

// Route::get('posts/{post}', function($id) { // Get post ID by wildcard
//     return view('post', [
//         'post'=> Post::findOrFail($id)
//     ]);
// });

Route::get('posts/{post:slug}', function(Post $post) { // Get post ID by route model binding
    return view('post', [
        'post'=> $post
    ]);
});

Route::get('categories/{category:slug}', function(Category $category) {
    return view('posts', [
        'posts' => $category->posts,
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);
});

Route::get('authors/{author:username}', function(User $author) {
    return view('posts', [
        'posts' => $author->posts
    ]);
});