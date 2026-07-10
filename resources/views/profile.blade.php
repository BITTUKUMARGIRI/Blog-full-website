<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Dashboard</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f6f9;
            margin:0;
            padding:20px;
        }
        .container{
            max-width:1200px;
            margin:auto;
        }
        .profile-box{
            background:#fff;
            padding:20px;
            border-radius:10px;
            margin-bottom:20px;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
        }
        .grid{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));
            gap:20px;
        }
        .section{
            background:#fff;
            padding:20px;
            border-radius:10px;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
        }
        .card{
            border:1px solid #ddd;
            border-radius:8px;
            padding:15px;
            margin-bottom:15px;
            background:#fafafa;
        }
        h1,h2,h3{
            margin-top:0;
        }
        video{
            width:100%;
            border-radius:8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-box">
            <h1>{{ $user->name }}'s Profile</h1>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone }}</p>
        </div>

        <div class="grid">
            <div class="section">
                <h2>My Posts</h2>
                @forelse($posts as $post)
                    <div class="card">
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->content }}</p>
                    </div>
                @empty
                    <p>No posts found.</p>
                @endforelse
            </div>

            <div class="section">
                <h2>My Videos</h2>
                @forelse($videos as $video)
                    <div class="card">
                        <h3>{{ $video->title }}</h3>
                        
                    </div>
                @empty
                    <p>No videos found.</p>
                @endforelse
            </div>

            <div class="section">
                <h2>Saved Posts</h2>
                @forelse($savedPosts as $savedPost)
                    @if($savedPost->post)
                        <div class="card">
                            <h3>{{ $savedPost->post->title }}</h3>
                            <p>{{ $savedPost->post->content }}</p>
                        </div>
                    @endif
                @empty
                    <p>No saved posts found.</p>
                @endforelse
            </div>

            <div class="section">
                <h2>Saved Videos</h2>
                @forelse($savedVideos as $savedVideo)
                    @if($savedVideo->video)
                        <div class="card">
                            <h3>{{ $savedVideo->video->title }}</h3>
                            <video controls>
                                <source src="{{ asset('storage/' . $savedVideo->video->video) }}" type="video/mp4">
                            </video>
                        </div>
                    @endif
                @empty
                    <p>No saved videos found.</p>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>