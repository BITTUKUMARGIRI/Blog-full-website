<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Save;    
use App\Models\Video;
use app\Models\Like;
use app\models\SaveVideo;
use Illuminate\Support\Facades\Hash;        
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class authcontroller extends Controller
{
   public function register(Request $request){
    $validator = Validator::make($request->all(), [
        'name'=>'required',
        'email'=>'required_without:phone|email|nullable|unique:users',
        'phone'=>'required_without:email|nullable|unique:users',
        'password'=>'required|min:6',
        'role'=>'required|in:admin,user',
    ]);

    if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();

    }

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->password = Hash::make($request->password);
    $user->role = $request->role;   
    $user->save();

    return redirect()->route('login')->with('success', 'Register success, now login');
   }

   public function login(Request $request){
    $validator = Validator::make($request->all(), [
        'email'=>'nullable|required_without:phone|email',
        'phone'=>'nullable|required_without:email',
        'password'=>'required|min:6'
    ]);

    // if ($validator->fails()) {
    //     return response()->json([
    //         'status' => 'error',
    //         'errors' => $validator->errors()
    //     ], 422);    }

    $credentials = $request->only('email', 'phone', 'password');
    if (Auth::attempt($credentials)) {
       $request->session()->regenerate();
       return redirect()->route('welcome');
        
    } 
    else {
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

}

   public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}
public function profile()
{
    $user = Auth::user();

    $posts = $user->posts()->latest()->get();
    $videos = $user->videos()->latest()->get();

    $savedPosts = $user->saves()
        ->where('save', 'post')
        ->latest()
        ->get();

       $savedVideos = $user->saveVideos()->with('video')->latest()->get();

    return view('profile', compact('user', 'posts', 'videos', 'savedPosts', 'savedVideos'));
}
}