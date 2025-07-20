<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;


class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::when(request('category_id'), function ($query) { 
            $query->where('category_id', request('category_id'));
        })->latest()->get();
        $categories = Category::all();

        return view('home', compact('categories', 'posts'));
    }
}
