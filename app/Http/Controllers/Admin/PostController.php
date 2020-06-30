<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $categoryOptions = [];

        foreach ($categories as $category) {
            $categoryOptions[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tagOptions = [];

        foreach ($tags as $tag) {
            $tagOptions[$tag->id] = $tag->name;
        }

        return view('admin.posts.edit', compact('post', 'categoryOptions', 'tagOptions'));
    }

    public function update(Post $post)
    {
        request()->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'body' => ['required', 'min:100'],
            'category_id' => ['required', 'integer'],
            'slug' => ['min:5', 'unique:posts'],
            'image' => ['sometimes', 'image'],
            'is_approved' => 'required',
        ]);

        $post->title = request()->title;
        $post->body = request()->body;
        $post->slug = Str::slug(request()->title, '-') . '-' . Post::rand_str(4);
        $post->is_approved = request()->is_approved;
        $post->category_id = request()->category_id;

        if (request()->image) { 
            $imagePath = request('image')->store('images', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1920, 1080);
            $image->save();
            
            $oldImagePath = $post->image;
            $post->image = $imagePath;
            
            Storage::delete('public/' . $oldImagePath);
        }

        $post->save();

        $post->tags()->sync(request()->tags);

        return redirect()->route('admin.posts.index')->with('success', 'Post successfully updated!');
    }

    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->comments()->delete();
        $post->delete();
     
        return redirect()->route('admin.posts.index')->with('success', 'Post successfully deleted!');
    }
}
