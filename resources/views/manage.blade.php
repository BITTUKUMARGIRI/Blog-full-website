<!DOCTYPE html>
<html>
<head>
    <title>Edit Video</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }

        .card{
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        input, textarea{
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .actions{
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn{
            padding: 10px 16px;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-update{ background: green; }
        .btn-cancel{ background: gray; }
        .btn-delete{ background: red; }
    </style>
</head>
<body>

<div class="card">
    <h1>Edit Video</h1>

    <form action="{{ url('/videos/' . $video->id,'edit') }}" method="POST">
        @csrf
        @method('PUT')

        <label>Title</label>
        <input type="text" name="title" value="{{ old('title', $video->title) }}">

        <!-- <label>Content</label>
        <textarea name="content" rows="5">{{ old('content', $video->content) }}</textarea> -->

        <div class="actions">
            <button type="submit" class="btn btn-update"> Update</button>
            <a href="{{ url('/video') }}" class="btn btn-cancel">Cancel</a>
        </div>
    </form>

    <form action="{{ url('/videos/' . $video->id) }}" method="POST" style="margin-top:15px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-delete"><a href="{{ url('/videos/' . $video->id . '/delete') }}" >Delete</a></button>
        
    </form>
</div>

</body>
</html>