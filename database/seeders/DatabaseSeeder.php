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
        // Now since we have Factory for User, Category and Post, we can seed the database

        /** Incase you want to randomly crete all inputs except name for Model user then we can simply do */
        $user = User::factory()->create([
            'name' => 'Alpha Guru',
        ]);
        // with the help of Factory.
        // We will not need to TRAUNCATE the tables, unless we are not running migrate:refresh first

        Post::factory(5)->create([
            //Incase we want to override user id with the user we created above
            'user_id' => $user->id,
        ]); // Create 5 posts
        // NB: Post will create User and Category automatically

        /*
        // Trancate the Table before seeding
        Post::truncate();
        User::truncate();
        Category::trauncate();


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
            'excerpt' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>',
            'body' => "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>",
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My second post',
            'slug' => 'my-second-post',
            'excerpt' => '<p>Contrary to popular belief, Lorem Ipsum is not simply random text.</p>',
            'body' => "<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>",
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My third post',
            'slug' => 'my-third-post',
            'excerpt' => '<p>Contrary to popular belief, Lorem Ipsum is not simply random text.</p>',
            'body' => "<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>",
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My fourth post',
            'slug' => 'my-fourth-post',
            'excerpt' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>',
            'body' => "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>",
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $personal->id,
            'title' => 'My fifth post',
            'slug' => 'my-fifth-post',
            'excerpt' => '<p>Personal Blog is simply dummy text of the printing and typesetting industry.</p>',
            'body' => "<p>Personal Blog is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>",
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $work->id,
            'title' => 'My sixth post',
            'slug' => 'my-sixth-post',
            'excerpt' => '<p>Sixth Ipsum is simply post dummy text of the printing and typesetting industry.</p>',
            'body' => "<p>Sixth Ipsum simple blog post dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>",
        ]);
        */
    }
}
