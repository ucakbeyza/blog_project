<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Post::with('category')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created post in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required', 
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048' 
    ]);

    $postData = [
            'title' => $validated['title'],
            'content' => $validated['content'], 
            'category_id' => $validated['category_id']
    ];

    if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/blog_images');
            $postData['image'] = str_replace('public/', '', $imagePath);
    } 
    else {
            
        $postData['image'] = 'image/placeholder/default-post.jpg'; 
    }

        Post::create($postData);

        return redirect()->route('posts.index')->with('success', 'Post created');
}

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        return view("article", compact("post"));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $postData = $request->only(['title', 'content', 'category_id']);

        if ($request->hasFile('image')) {
        
            if ($post->image && !str_starts_with($post->image, 'image/placeholder/')) {
                Storage::delete('public/' . $post->image);
            }
        
            $imagePath = $request->file('image')->store('public/blog_images');
            $postData['image'] = str_replace('public/', '', $imagePath);
        }
  

        $post->update($postData);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
    
}
