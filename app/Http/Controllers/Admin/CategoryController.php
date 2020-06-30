<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Tag;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    
    public function index()
    {
        $categories = Category::paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'min:2', 'max:50', 'unique:categories'],
        ]);

        $category = new Category();
        $category->name = request()->name;

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category successfully created!');
    }

    public function show(Category $category)
    {
        $categories = Category::all();   
        $tags = Tag::all();

        return view('admin.categories.show', compact('category', 'categories', 'tags'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Category $category)
    {
        request()->validate([
            'name' => ['required', 'min:2', 'max:50', 'unique:categories'],
        ]);

        $category->name = request()->name;

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category successfully updated!');
    }

    public function destroy(Category $category)
    {
        $category->posts()->delete();
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category successfully deleted!');
    }
}
