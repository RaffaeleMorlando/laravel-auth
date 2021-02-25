<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index() 
    {

        $posts = Post::all();

        return view('guest.posts.index', compact('posts'));
    }

    public function show(Post $post) 
    {
        dump($post);

        return view('guest.posts.show', compact('post'));
    }
    
}