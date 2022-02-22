<?php
// Laravel Modal class
namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class FilePosts
{

    /**
     * @param $title
     * @param $excerpt
     * @param $date
     * @param $body
     */

    public function __construct(public $title, public $excerpt, public $date,public $body,public $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
        /**
         * Reading files and content
         */
        return collect(File::files(resource_path('posts')))
            ->map(fn($file) => YamlFrontMatter::parseFile($file))
            ->map(fn($doc) => new FilePosts(
                $doc->title,
                $doc->excerpt,
                $doc->date,
                $doc->body(),
                $doc->slug,
            ));
    }


    public static function getPost($slug)
    {
        // File path to the post dir
        // Before we used $path = __DIR__ . '/../resources/posts/' . $slug . '.html';
        // But laravel has some helpers to get the path 1: base_path() 2: resource_path() 3: app_path()
        $path = resource_path('posts/' . $slug . '.html');

        // Check if post file exists
        if (!file_exists($path)) {
            // Before we just aborted [abort(404)] or riderected to home page but this Model is not for that kind or work

            //So now we can use the laravel exception class
            // --- throw new \Exception('Post not found');
            // OR
            throw new ModelNotFoundException();


            /**
             * We can redirect by : return redirect('/');
             *
             * We can die and dump by : dd($path);
             *
             * We can die and dump using laravel error page by: ddd($path);
             *
             * abourt(403);
             * abort(403, "You are not allowed to access this page.");
             */
        }

        // Cache the post
        /**
         * remember(
         * 1: file name include the folder path under views
         * 2: time to cache the file in seconds like 60 or use laravel helpers like addSeconds(), addMinutes(), addHours(), addDays(), addWeeks, addMonths(), addYears()
         *
         * )
         */
        $post = cache()->remember("posts.$slug", now()->addSeconds(10), function () use ($path) {
            //Set file content to post
            return file_get_contents($path);
        });

        // from php 7.4 we can use the following code
        // $post = cache()->remember("posts.$slug", now()->addSeconds(10), fn() => file_get_contents($path));
        return $post;
    }
}
