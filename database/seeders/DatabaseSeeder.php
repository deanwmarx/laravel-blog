<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Category::truncate();
        Post::truncate();

        $user = User::factory()->create();

        $personal = Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        $family = Category::create([
            'name' => 'Family',
            'slug' => 'family'
        ]);

        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My Family Post',
            'slug' => 'my-family-post',
            'excerpt' => 'Lorem ipsum dolar sit amet.',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec bibendum ante. Ut metus massa, venenatis et arcu et, semper facilisis metus. Phasellus non placerat ipsum. Phasellus sed mauris nec mi blandit hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vivamus in blandit tortor. Cras lorem nulla, semper vitae rutrum non, vehicula a augue. Nulla sem ipsum, pulvinar ut lacus dictum, tincidunt imperdiet velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut cursus, nunc in finibus eleifend, mi arcu aliquet elit, venenatis elementum nisi odio quis tortor. Vestibulum sodales lorem vel eros pharetra, at fringilla ante tristique. Mauris porttitor vitae lacus et volutpat. Vivamus quis ligula nibh. Nulla at sem dui. Pellentesque tristique nisi ut est commodo, id pulvinar leo accumsan. Morbi quis laoreet urna.</p>'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $work->id,
            'title' => 'My Work Post',
            'slug' => 'my-Work-post',
            'excerpt' => 'Lorem ipsum dolar sit amet.',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec bibendum ante. Ut metus massa, venenatis et arcu et, semper facilisis metus. Phasellus non placerat ipsum. Phasellus sed mauris nec mi blandit hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vivamus in blandit tortor. Cras lorem nulla, semper vitae rutrum non, vehicula a augue. Nulla sem ipsum, pulvinar ut lacus dictum, tincidunt imperdiet velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut cursus, nunc in finibus eleifend, mi arcu aliquet elit, venenatis elementum nisi odio quis tortor. Vestibulum sodales lorem vel eros pharetra, at fringilla ante tristique. Mauris porttitor vitae lacus et volutpat. Vivamus quis ligula nibh. Nulla at sem dui. Pellentesque tristique nisi ut est commodo, id pulvinar leo accumsan. Morbi quis laoreet urna.</p>'
        ]);
    }
}
