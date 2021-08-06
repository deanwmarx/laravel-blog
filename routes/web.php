<?php

use App\Models\Post;
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

    // return Post::find('my-first-post'); // You can now run the function in the Post class to find any specified value.

    // $files = File::files(resource_path("posts")); //No longer needed in Third and best way as looks cleaner inline.

    // $posts = collect(File::files(resource_path("posts"))) // Third and best way can also be improved as arrow functions below
    //     ->map(function ($file) {
    //         return YamlFrontMatter::parseFile($file);
    //     })  

    //     ->map(function ($document) {
    //         return new Post (
    //             $document->title,
    //             $document->excerpt,
    //             $document->date,
    //             $document->body(),
    //             $document->slug
    //         );
    //     });

    // $posts = collect(File::files(resource_path("posts"))) 
    //     ->map(fn($file) => YamlFrontMatter::parseFile($file))
    //     ->map(fn($document) => new Post (
    //         $document->title,
    //         $document->excerpt,
    //         $document->date,
    //         $document->body(),
    //         $document->slug
    //     ));

    // $posts = Post::all();

    // $posts = array_map(function ($file) { // Second Way
    //     $document = YamlFrontMatter::parseFile($file);

    //     return new Post (
    //         $document->title,
    //         $document->excerpt,
    //         $document->date,
    //         $document->body(),
    //         $document->slug
    //     );
    // }, $files);

     // $posts = []; // First way

    // foreach ($files as $file) {
    //     $document = YamlFrontMatter::parseFile($file);

    //     $posts[] = new Post(
    //         $document->title,
    //         $document->excerpt,
    //         $document->date,
    //         $document->body(),
    //         $document->slug
    //     );
    // }

    // ddd($document->slug);

    
    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('posts/{post}', function($slug) {

    // Find a post by its slug and pass it to a view called "post"

    $post = Post::find($slug);

    return view('post', ['post' => $post]);


    // if (! file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {
    //     return redirect('/');
    //     // abort(404); // To make a 404 not found page apear (built into Laravel)
    // }

    // // dd($path); 
    // // ddd($path); // Die, Dump and Debug, useful for knowing $path exists.

    // $post = cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path)); // You can use now()->addMinute(1) or now()->addHour(1) or now()->AddDay(1) etc. instead of 1200 (seconds)
    //     // var_dump('file_get_contents'); // To test if file_get_contents() successfully running and caching $path
    //     // return file_get_contents($path);
    // // }); // Old way of running function as funtion() instead of fn() => (Pre php7.4)

    // // $post = file_get_contents($path); // Run without caching

    // return view('post', ['post' => $post]);

})->where('post', '[A-z_/-]+');;