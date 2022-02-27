<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Models\FilePosts;
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

    // We need to get All Posts
     $posts = FilePosts::all();

    // We need to get the first post
    /**
     * $posts[0]->getContents();
     * if we return the contents of the files | File::files(resource_path('posts/'));
     */

    // dd($posts);
    // Return the view with variable post
     return view('posts', [
         'posts' => $posts
     ]);
});

/** Wildcard */
Route::get('posts/{path}', function ($slug) {


    /**
     * Here we can use Model FilePosts to find our post
     */
    // Return the view with variable post
    return view('post', [
        'post' => FilePosts::getPostOrFail($slug)
    ]);
})->where('path', '[A-Za-z0-9-_]+'); // also there are helpers like whereAlpaNumeric() , whereAlpha() , whereNumeric()

/***
 * For Eloquent Reading
 */
Route::get('/home', function () {
    //Get All the posts
    $posts = Post::all();

    // Return the view with variable post
    return view('elo-posts', [
        'posts' => $posts
    ]);
});

/***
 * For Eloquent Reading Signle Post
 */
Route::get('/mypost/{id}', function ($id) {
    //Get All the posts
    $post = Post::findOrFail($id);

    // Return the view with variable post
    return view('elo-post', [
        'post' => $post
    ]);
});
