<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

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
     
}
