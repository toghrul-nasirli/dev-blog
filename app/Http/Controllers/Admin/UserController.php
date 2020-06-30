<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(User $user)
    {
        $user->roles()->sync(request()->roles);

        return redirect()->route('admin.users.index')->with('success', 'User\'s role successfully updated!');
    }

    public function destroy(User $user)
    {
        $user->roles()->detach();
        foreach ($user->posts as $post) {
            $post->tags()->detach();    
        }
        $user->posts()->delete();
        
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User successfully deleted!');
    }
}
