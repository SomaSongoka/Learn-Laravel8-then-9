<?php

use App\Models\Category;
use App\Models\Owner;
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
 *
 * This approach is call Route Model Binding
 * NB: The wildcard has to much with the variable in our callback function [post] $post
 *
 * Now lets try to use slug to find post instead of id
 * we will state /mypost/{post:slug}, function (Post $post) in background Laravel will do Post::where('slug', post)->firstOrFail() post being our wildcard we provided
 *
 * Another cool way if slug will forever be the identifier of the post is to declare it in the model
 *
 * Go to Post Model and Generate Method getRouteKeyName() then return 'slug' as the identifier
 * -> And you will not have to write {post:slug} in your route it will be simply {post}
 */
Route::get('/mypost/{post:slug}', function (Post $post) {

    // Return the view with variable post
    return view('elo-post', [
        'post' => $post
    ]);
});

/***
 * Let's generate a new route for categories
 * This route will show all post belongs to a category
 *
 * We will use Route Model Binding
 */
Route::get('/category/{category:slug}', function (Category $category) {
    // Let's go to Model Category and create a new relationship called posts() which we will refer in this route using $category->posts()
    // Return the view with variable post -- we will re-use the same view as the previous route
    return view('elo-posts', [
        'posts' => $category->posts
    ]);
});
