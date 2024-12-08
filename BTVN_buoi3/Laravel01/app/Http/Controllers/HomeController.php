<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        // Trả về view với biến $posts
        return view('home', compact('posts')); 
    }
}
