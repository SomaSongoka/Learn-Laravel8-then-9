<?php

use Illuminate\Support\Facades\Route;
use App\Models\FilePosts;

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


    /**
     * Here we can use Model FilePosts to find our post
     */
    $post = FilePosts::getPost($slug);

    // Return the view with variable post
    return view('post', [
        'post' => $post
    ]);
})->where('path', '[A-Za-z0-9-_]+'); // also there are helpers like whereAlpaNumeric() , whereAlpha() , whereNumeric()
