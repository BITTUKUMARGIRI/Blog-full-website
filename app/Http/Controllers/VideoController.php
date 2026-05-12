<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Video;
USE Illuminate\Support\Facades\Storage;
USE Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;



class VideoController extends Controller
{
    public function watch(Request $request)
    {
        return view('watch'); 
    }
    public function store(Request $request)
   {
//dd($request->all(), $request->file('video'));
    $request->validate([
        
        'title' => 'required|string|max:255',
        'video' => 'required|file|mimes:mp4,mov,avi,webm|max:51200',
    ]);
    
    if (!$request->hasFile('video')) {
        return back()->with('error', 'No video file received');
    }


    $path = $request->file('video')->store('videos', 'public');

    video::create([
        'title' => $request->title,
        'video' => $path,
        'video_id' => auth()->id(),
    ]);
    

   return redirect()->route('welcome' )->with('success', 'Video uploaded successfully');
}

   public function video(){
video::all();
return view('video', ['videos' => video::all()]);
   }
 
    public function play($id){
     $videos = video::findOrFail($id);
     return view('play', compact('videos'));
    }

    public function manage($id)
    {
        $video = video::findOrFail($id);
        if (auth()->id() !== $video->video_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('manage', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = video::findOrFail($id);
        if (auth()->id() !== $video->video_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $video->update([
            'title' => $request->title
        ]);

        return redirect()->route('video', $video->id)->with('success', 'Video updated successfully');
    }
    
    public function delete($id)
    {
        $video = video::findOrFail($id);
        if (auth()->id() !== $video->video_id) {
            abort(403, 'Unauthorized action.');
        }

        Storage::disk('public')->delete($video->video);
        $video->delete();

        return redirect()->route('video')->with('success', 'Video deleted successfully');
    }

    public function search(Request $req){
        $searchTerm = $req->input('search');
        $videos = video::where('title', 'LIKE', '%' . $searchTerm . '%')->get();
        return view('video', ['videos' => $videos]);
    
   if($videos->isEmpty()){
    return view('video', compact('videos'));
}
}
}
