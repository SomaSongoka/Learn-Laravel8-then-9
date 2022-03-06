<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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
    /**
     * By Intoduction a $post->category->slug in the view we have created a what called n+1 problem
     *
     * Lets Log the DB for a all post page
     * 1: load the DB facade
     * 2: log the DB query
     */
    \Illuminate\Support\Facades\DB::listen(function ($query) {
        //To log the query use the following code:  \Illuminate\Support\Facades\Log::info($query->sql);
        // OR use logger
        logger($query->sql); // To see The binding values just add logger($query->sql, $query->bindings);
        // The logs can be found in storage/logs/laravel.log
    });

    /**
     * But that way sometimes it can be tiresome, so let's use a tool called Laravel Clockwork
     * https://github.com/itsgoingd/clockwork
     * : Install composer require itsgoingd/clockwork
     * : The add the browser extension
     * : Now all the queries will be seen in the browser console
     */


    // Return the view with variable post
    return view('elo-posts', [
        // Now The n+1 problem here is we are querying the posts the category for each of the post
        //'posts' => Post::all()
        /**
         * So we can fix this problem which is caused by lazy loading default by laravel
         */
        'posts' => Post::latest()->with('author')->get()
        //Remember once we use with we need to use the get() method to get the data

        // Since we have eager loaded the category we no longer have to refer it, but the problem is now  everytime we
        // load the Post the whole categeory will be loaded by default, so if we load author we will end up with a lot of data
        // we are not using or need

        /**
         * To escape this we can always say
         * ***** Post::latest()->without('category')->get()
         * OR
         * ***** Post::latest()->without(['category','author'])->get()
         */

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
        'posts' => $category->posts->load('author')
    ]);
});

/**
 * Let's display the Author's post
 * We will use Route Model Binding
 */
Route::get('/author/{user:username}', function (User $user) {
    // We can use load() to load the relationship in the view while avoiding n+1 problem
    return view('elo-posts', [
        'posts' => $user->posts
    ]);
});

/***
 *
 * Elo-Post Routes Duplicated for Blog
 */

// View All Posts
Route::get('/blog', function () {
    return view('blog-posts', [
        'posts' => Post::latest()->with('author')->get(),
        'categories' => Category::all()
    ]);
})->name('home');

// View Single Post
Route::get('/blog/{post:slug}', function (Post $post) {
    return view('blog-post', [
        'post' => $post
    ]);
});

// View Post category
Route::get('/blog/category/{category:slug}', function (Category $category) {
    return view('blog-posts', [
        'posts' => $category->posts->load('author'),
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);
})->name('blog-category');

// View Author Posts
Route::get('/blog/author/{user:username}', function (User $user) {
    return view('blog-posts', [
        'posts' => $user->posts,
        'categories' => Category::all()
    ]);
});
