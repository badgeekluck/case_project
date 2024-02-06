<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(25)->create();
        Category::factory()->count(10)->create();
        Post::factory()->count(250)->create();

        $posts = Post::all();

        foreach ($posts as $post) {
            $post->categories()->attach(
                Category::inRandomOrder()->take(random_int(1,9))->pluck('id')
            );
        }
    }
}
