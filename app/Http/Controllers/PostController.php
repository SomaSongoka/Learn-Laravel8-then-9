<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //1: Instead of Post::latest()->with('author')->get() {Get = execute the bilded query} we can do this
        $posts = Post::latest()->with('author');
        //2: Then let's check if request()->has('search') or you can write if(request('search')) | search is our GET request [name=search]
        if (request()->has('search')) {
            //3: If we have search then we will use the where() method to search the title

            //NB: This will be executed only if the request has search. Here we now join the query building by adding the where clause
            $posts->where('title', 'like', '%' . request()->get('search') . '%')
                ->orWhere('body', 'like', '%' . request('search') . '%'); // Check on Title and Body
            // The above code can be $posts->where('title', 'like', '%' . request('search') . '%');
        }

        return view('blog-posts', [
            'posts' => $posts->get(), //Post::latest()->with('author')->get(),
            'categories' => Category::all()
        ]);

    }
}
