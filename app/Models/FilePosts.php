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
        // To avoid re-reading the files every time: we are going to cache the posts files
        return cache()->remember(now()->addMinutes(1),'posts.all', function () {
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
                ))
                ->sortByDesc('date');
        });

    }


    public static function getPost($slug)
    {
        //Find the post that matches the slug and return it
        return self::all()->firstWhere('slug', $slug);

    }
}
