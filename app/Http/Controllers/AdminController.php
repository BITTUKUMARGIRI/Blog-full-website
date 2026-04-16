<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Route;


class AdminController extends Controller
{
    public function create(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',]);
        
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->user_id = auth()->id();
        $post->save();
        return redirect()->route('welcome' )->with('success', 'Post created successfully!');
    }
   
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    Post::create([
        'title' => $request->title,
        'content' => $request->content,
        'user_id' => auth()->id(),
    ]);

    return redirect()->back()->with('success', 'Post created successfully');
}
    public function edit($id)
    {
        $post = Post::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
        return view('edit', compact('post'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->save();

        return redirect()->route('welcome')->with('success', 'Post updated successfully!');
    }
    public function delete($id){
        $post=Post::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
        $post->delete();
        return redirect()->route('welcome')->with('success', 'Post deleted successfully!');
    }
}
