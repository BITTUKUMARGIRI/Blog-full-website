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
            'description' => 'required|string',]);
        
       Post::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'user_id' => auth()->id(),
    ]); return redirect()->route('welcome' )->with('success', 'Post created successfully!');
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
            'description' => 'required|string',
        ]);

        $post = Post::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
        $post->title = $validatedData['title'];
        $post->description = $validatedData['description'];
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
