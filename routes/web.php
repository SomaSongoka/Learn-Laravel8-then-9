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

    //Set file content to post
    $post = file_get_contents($path);

    // Return the view with variable post
    return view('post', [
        'post' => $post
    ]);
})->where('path', '[A-Za-z0-9-_]+'); // also there are helpers like whereAlpaNumeric() , whereAlpha() , whereNumeric()
