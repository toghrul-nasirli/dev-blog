<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'view']]);
    }

    public function index()
    {
        $posts = Post::where('is_approved', '=', true)->latest()->paginate(5);
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    public function create()
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

        return view('posts.create', compact('categoryOptions', 'tagOptions'));
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'body' => ['required', 'min:100'],
            'category_id' => ['required', 'integer'],
            'slug' => ['min:5', 'unique:posts'],
            'image' => ['sometimes', 'image'],
        ]);

        $post = new Post();
        $post->title = request()->title;
        $post->body = request()->body;
        $post->slug = Str::slug(request()->title, '-') . '-' . Post::rand_str(4);
        $post->is_approved = false;
        $post->user_id = auth()->user()->id;
        $post->category_id = request()->category_id;

        if (request()->hasFile('image')) { 
            $imagePath = request('image')->store('images', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1920, 1080);
            $image->save();
            
            $post->image = $imagePath;
        }

        $post->save();

        $post->tags()->sync(request()->tags, false);

        return redirect()->route('posts.show', $post->id)->with('warning', 'Your post waiting approve!');
    }

    public function show(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $comments = Comment::all();

        return view('posts.show', compact('post', 'categories', 'tags', 'comments'));
    }

    public function view($slug)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $comments = Comment::all();

        $post = Post::where('slug', '=', $slug)->first();

        return view('posts.show', compact('post', 'categories', 'tags', 'comments'));
    }

    public function own() {
        $posts = Post::where('user_id', '=', auth()->user()->id)->paginate();
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.own', compact('posts', 'categories', 'tags'));
    }

    public function edit(Post $post)
    {
        if (auth()->user()->id != $post->user_id) {
            return redirect()->back()->with('error', 'Unauthorized Page!');
        }

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

        return view('posts.edit', compact('post', 'categoryOptions', 'tagOptions'));
    }

    public function update(Post $post)
    {
        request()->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'body' => ['required', 'min:100'],
            'category_id' => ['required', 'integer'],
            'slug' => ['min:5', 'unique:posts'],
            'image' => ['sometimes', 'image'],
        ]);

        $post->title = request()->title;
        $post->body = request()->body;
        $post->slug = Str::slug(request()->title, '-') . '-' . Post::rand_str(4);
        $post->is_approved = false;
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

        return redirect()->route('posts.show', $post->id)->with('warning', 'Your post update waiting approve!');
    }

    public function destroy(Post $post)
    {
        if (auth()->user()->id != $post->user_id) {
            return redirect()->back()->with('error', 'Unauthorized Page!');
        }

        $post->tags()->detach();
        $post->comments()->delete();
        Storage::delete('public/' . $post->image);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post successfully deleted!');
    }
}
