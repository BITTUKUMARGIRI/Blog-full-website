<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Blog Site</title>
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

        .navbar h2 a {
            color: white;
            text-decoration: none;
        }

        .btn {
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

        .btn:hover {
            background: darkorange;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        .form-box {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 30px;
        }

        .form-title {
            font-size: 28px;
            margin-bottom: 20px;
            color: #222;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
        }

        textarea.form-control {
            min-height: 250px;
            resize: vertical;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 6px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px auto;
                padding: 15px;
            }

            .form-box {
                padding: 20px;
            }

            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    
@if(auth()->check() && auth()->id() == $post->user_id)
    <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
@endif

    <div class="navbar">
        <h2><a href="{{ url('/') }}">Blog Site</a></h2>
        <a href="{{ url('/posts/' . $post->id) }}" class="btn">Back</a>
    </div>

    <div class="container">
        <div class="form-box">

            <h1 class="form-title">Edit Post</h1>
                 
            <form action="{{ url('/posts/' . $post->id . '/edit') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}">

                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Post Content</label>
                    <textarea name="content" id="content" class="form-control">{{ old('content', $post->content) }}</textarea>

                    @error('content')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="actions">
                    <button type="submit" class="btn">Update Post</button>
                    <a href="{{ url('/posts/' . $post->id) }}" class="btn">Cancel</a>
                    <a href="{{ url('/posts/' . $post->id . '/delete') }}" class="btn">Delete Post</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>