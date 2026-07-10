<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Save;

class ReadController extends Controller
{
    public function index(){
        $posts=Post::latest()->paginate(6);
        return view('read', compact('posts'));
    }
   public function show($id)
{
    $post = Post::findOrFail($id);
    return view('FullPost', compact('post'));
}

 public function like($id)
{
    $post = Post::findOrFail($id);
    $user = Auth::user();

    $savedPost = Save::where('user_id', $user->id)
        ->where('post_id', $post->id)
        ->where('save', 'post')
        ->first();

    if ($savedPost) {
        $savedPost->delete();
        return back()->with('success', 'Post unliked successfully');
    }

    Save::create([
        'user_id' => $user->id,
        'post_id' => $post->id,
        'save' => 'post'
    ]);

    return back()->with('success', 'Post liked successfully');
}
     
}
