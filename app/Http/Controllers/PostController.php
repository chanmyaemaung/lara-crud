<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Cache::remember('posts-page' . request('page', 1), 60 * 3, function () {
            return Post::with('category')->orderBy('created_at', 'desc')->paginate(5);
        });

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories  = Category::all();

        // Clear cache
        Cache::forget('posts-page' . request('page', 1));

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();

        // Validate the request
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', 'integer'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);


        // Check file exists
        if ($request->hasFile('image')) {
            // Store the image
            $fileName = time() . '_' . str_replace(' ', '_', $request->image->getClientOriginalName());
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
            $post->image = '/storage/' . $filePath;
        }


        // Store data in the database
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category;
        $post->status = 1;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $post = Post::findOrFail($id);

        $post = Cache::remember('post-' . $id, 60 * 3, function () use ($id) {
            return Post::findOrFail($id);
        });

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        // Validate the request
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', 'integer'],
        ]);


        // Check file exists
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            ]);

            // Delete the old image
            if (File::exists(public_path($post->image))) {
                File::delete(public_path($post->image));
            }

            // Store the image
            $fileName = time() . '_' . str_replace(' ', '_', $request->image->getClientOriginalName());
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
            $post->image = '/storage/' . $filePath;
        }


        // Store data in the database
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category;
        $post->save();

        // Clear cache
        Cache::flush();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // Delete the post
        $post->delete();

        // Clear cache
        Cache::forget('posts-page' . request('page', 1));

        return redirect()->route('posts.index')->with('success', 'Your post has been deleted successfully.');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate(5);

        return view('posts.trashed', compact('posts'));
    }

    public function restore(string $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        $post->restore();

        // Clear cache
        Cache::forget('posts-page' . request('page', 1));

        return redirect()->route('posts.index')->with('success', 'Your post has been restored successfully.');
    }

    public function forceDestroy(string $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        // Delete the image
        if (File::exists(public_path($post->image))) {
            File::delete(public_path($post->image));
        }

        // Delete the post
        $post->forceDelete();

        return redirect()->route('posts.index')->with('success', 'Your post has been deleted successfully.');
    }

    public function clearCache()
    {
        Cache::flush();

        return redirect()->route('posts.index')->with('success', 'Cache cleared successfully.');
    }
}
