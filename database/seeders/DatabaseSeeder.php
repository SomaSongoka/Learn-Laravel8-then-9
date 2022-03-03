<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Trancate the Table before seeding
        User::truncate();

        // Seed the table with the data 1 user
        $user = User::factory()->create();

        // Seed Category Table
        $personal = Category::create(
            [
                'name' => 'Personal',
                'slug' => 'personal',
            ]
        );

        $family = Category::create(
            [
                'name' => 'Family',
                'slug' => 'family',
            ]
        );

        $work = Category::create(
            [
                'name' => 'Work',
                'slug' => 'work',
            ]
        );

        // Seed the table with the data 1 post
        Post::create([
            'user_id' => $user->id,
            'category_id' => $personal->id,
            'title' => 'My first post',
            'slug' => 'my-first-post',
            'excerpt' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'body' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My second post',
            'slug' => 'my-second-post',
            'excerpt' => 'Contrary to popular belief, Lorem Ipsum is not simply random text.',
            'body' => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My third post',
            'slug' => 'my-third-post',
            'excerpt' => 'Contrary to popular belief, Lorem Ipsum is not simply random text.',
            'body' => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My fourth post',
            'slug' => 'my-fourth-post',
            'excerpt' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'body' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $personal->id,
            'title' => 'My fifth post',
            'slug' => 'my-fifth-post',
            'excerpt' => 'Personal Blog is simply dummy text of the printing and typesetting industry.',
            'body' => "Personal Blog is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $work->id,
            'title' => 'My sixth post',
            'slug' => 'my-sixth-post',
            'excerpt' => 'Sixth Ipsum is simply post dummy text of the printing and typesetting industry.',
            'body' => "Sixth Ipsum simple blog post dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        ]);
    }
}
