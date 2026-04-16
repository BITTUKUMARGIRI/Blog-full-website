<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Blog Site</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Times New Roman", serif;
        }

        body {
            background: #dcdcdc;
            min-height: 100vh;
            padding: 30px 15px;
        }

        .topbar {
            max-width: 900px;
            margin: 0 auto 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .site-title a {
            text-decoration: none;
            color: #222;
            font-size: 24px;
            font-weight: bold;
        }

        .btn {
            background: orange;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 6px;
            display: inline-block;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        .btn:hover {
            background: darkorange;
        }

        .paper {
            width: 210mm;
            min-height: 297mm;
            max-width: 100%;
            margin: auto;
            background: white;
            padding: 30mm 22mm;
            box-shadow: 0 0 18px rgba(0,0,0,0.18);
            border: 1px solid #ccc;
        }

        .post-title {
            font-size: 34px;
            color: #111;
            margin-bottom: 12px;
            line-height: 1.3;
            text-align: center;
        }

        .post-date {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }

        .post-content {
            color: #222;
            font-size: 18px;
            line-height: 1.9;
            text-align: justify;
            word-wrap: break-word;
        }

        .post-content p {
            margin-bottom: 18px;
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            margin: 20px auto;
            display: block;
        }

        .actions {
            max-width: 900px;
            margin: 20px auto 0;
            text-align: justify;
            word-wrap: break-word;
        }

        @media (max-width: 768px) {
            body {
                padding: 15px 10px;
            }

            .paper {
                width: 100%;
                min-height: auto;
                padding: 25px 18px;
            }

            .post-title {
                font-size: 26px;
            }

            .post-content {
                font-size: 16px;
                line-height: 1.8;
            }

            .topbar {
                flex-direction: column;
                gap: 12px;
            }
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .topbar,
            .actions {
                display: none;
            }

            .paper {
                width: 210mm;
                min-height: 297mm;
                box-shadow: none;
                border: none;
                margin: 0;
            }
        }
    </style>
</head>
<body>

    <div class="topbar">
        <div class="site-title">
            <a href="{{ url('/') }}">Blog Site</a>
        </div>

        <div>
            <a href="{{ url('/read ') }}" class="btn">Back to Posts</a>
        </div>
    </div>
     @auth
    @if(Auth::user()->role === 'admin')
        <div class="actions">
            <a href="{{ url('/posts/' . $post->id . '/edit') }}" class="btn">Edit Post</a>
        </div>
    @endif
@endauth

    <div class="paper">
        <h1 class="post-title">{{ $post->title }}</h1>

        <div class="post-date">
            Posted on {{ $post->created_at ? $post->created_at->format('M d, Y h:i A') : 'No date available' }}
        </div>

        <div class="post-content">
            {!! html_entity_decode($post->content) !!}
        </div>
       
    </div>
    
    <!-- <div class="actions">
        <a href="{{ url('/') }}" class="btn">Back to Posts</a>
    </div> -->

</body>
</html>