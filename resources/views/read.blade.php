
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Posts - Blog Site</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f4f4;
            min-height: 100vh;
        }

        .navbar {
            width: 100%;
            background: #222;
            color: white;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            font-size: 24px;
        }

        .profile-btn {
            background: orange;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            text-decoration: none;
            display: inline-block;
        }

        .profile-btn:hover {
            background: darkorange;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            text-align: center;
        }

        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .post-card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .post-title {
            padding: 20px 25px 10px;
            font-size: 22px;
            color: #222;
            margin: 0;
        }

        .post-title a {
            text-decoration: none;
            color: inherit;
        }

        .post-title a:hover {
            color: #007bff;
        }

        .post-meta {
            padding: 0 25px 20px;
            color: #666;
            font-size: 14px;
        }

        .post-content {
            padding: 0 25px 25px;
            color: #555;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .no-posts {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .no-posts h3 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #222;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 40px;
        }

        .pagination a, .pagination span {
            padding: 12px 18px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-decoration: none;
            color: #222;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }

        .pagination .active a {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }

        @media (max-width: 768px) {
            .posts-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .container {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <div class="navbar">
        <h2><a href="{{ url('/') }}" style="color: white; text-decoration: none;">Blog Site</a></h2>
        
        @auth
            <div style="display: flex; align-items: center; gap: 12px;">
                <span>{{ Auth::user()->name }}</span>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ url('/create') }}" class="profile-btn">Create Post</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="profile-btn">Logout</button>
                </form>
            </div>
        @else
            <a href="{{ url('/') }}" class="profile-btn">Home</a>
        @endauth
    </div>

    <div class="container">
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($posts->count() > 0)
            <div class="posts-grid">
                @foreach($posts as $post)
                    <div class="post-card">
                        <h3 class="post-title">
                            <a href="{{ url('/posts/' . $post->id) }}">{{ $post->title }}</a>
                        </h3>
                        <div class="post-meta">
                            Posted on {{ $post->created_at?->format('M d, Y') }}
                        </div>
                        <div class="post-content">
                            {!! Str::limit(strip_tags($post->content), 150) !!}
                        </div>
                   <a href="{{ url('/posts/' . $post->id) }}" class="profile-btn" style="margin: 15px 25px 20px;">Read More</a>
                    </div>
                @endforeach
            </div>

            {{ $posts->links() }}
        @else
            <div class="no-posts">
                <h3>No posts yet</h3>
                <p>Create your first post to get started!</p>
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ url('/create') }}" class="profile-btn" style="margin-top: 20px; display: inline-block;">Create First Post</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>