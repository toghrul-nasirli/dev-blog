<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function index()
    {
        $tags = Tag::paginate(10);

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'min:1', 'max:50', 'unique:tags'],
        ]);

        $tag = new Tag();
        $tag->name = request()->name;

        $tag->save();

        return redirect()->route('admin.tags.index')->with('success', 'Tag successfully created!');
    }

    public function show(Tag $tag)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.tags.show', compact('tag', 'categories', 'tags'));
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Tag $tag)
    {
        request()->validate([
            'name' => ['required', 'min:2', 'max:50', 'unique:tags'],
        ]);

        $tag->name = request()->input('name');

        $tag->save();

        return redirect()->route('admin.tags.index')->with('success', 'Tag successfully updated!');
    }

    public function destroy(Tag $tag)
    {
        foreach ($tag->posts as $post) {
            if ($post->tags->count() == 1) {
                $post->delete();
            }
        }
        
        $tag->posts()->detach();
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('success', 'Tag successfully deleted!');
    }
}
