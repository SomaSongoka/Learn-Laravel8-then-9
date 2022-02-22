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
        //Find the post that matches the slug and return it
        return self::all()->firstWhere('slug', $slug);

    }
}
