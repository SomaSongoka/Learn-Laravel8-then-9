<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('posts', function () {
    return view('posts');
});

/** Wildcard */
Route::get('posts/{path}', function ($slug) {

    // File path to the post dir
    $path = __DIR__ . '/../resources/posts/' . $slug . '.html';

    // Check if post file exists
    if (!file_exists($path)) {
        abort(404);
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

    /**
     * 
     */

    // Return the view with variable post
    return view('post', [
        'post' => $post
    ]);
})->where('path', '[A-Za-z0-9-_]+'); // also there are helpers like whereAlpaNumeric() , whereAlpha() , whereNumeric()
