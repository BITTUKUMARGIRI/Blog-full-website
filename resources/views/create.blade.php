@if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 20px 0; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 20px 0; border: 1px solid #f5c6cb;">
        {{ session('error') }}
    </div>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #e5e5e5;
            min-height: 100vh;
            padding: 30px 15px;
        }

        .page-wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .paper-form {
            width: 210mm;
            min-height: 297mm;
            background: #fff;
            padding: 20mm;
            border: 1px solid #dcdcdc;
            box-shadow: 0 0 18px rgba(0, 0, 0, 0.12);
            border-radius: 6px;
        }

        .paper-form h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #222;
            font-size: 28px;
        }

        .title-input {
            width: 100%;
            border: none;
            border-bottom: 2px solid #999;
            font-size: 24px;
            font-weight: bold;
            padding: 10px 0;
            margin-bottom: 25px;
            outline: none;
            background: transparent;
        }

        .title-input:focus {
            border-bottom: 2px solid #2b7cff;
        }

        .content-box {
            width: 100%;
            min-height: 220mm;
            border: none;
            outline: none;
            resize: vertical;
            font-size: 17px;
            line-height: 1.8;
            color: #222;
            background: transparent;
        }

        .submit-btn {
            width: 100%;
            margin-top: 20px;
            padding: 14px;
            background: #222;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background: #000;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 6px;
            margin-bottom: 10px;
        }

        @media (max-width: 900px) {
            .paper-form {
                width: 100%;
                min-height: auto;
                padding: 20px;
            }

            .content-box {
                min-height: 500px;
            }
        }
    </style>
</head>
<body>

    <div class="page-wrapper">
        <form class="paper-form" method="POST" action="{{ route('create') }}">
            @csrf

            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <h2>Create Post</h2>

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <input 
                type="text" 
                name="title" 
                class="title-input" 
                placeholder="Enter post title"
                value="{{ old('title') }}"
            >
            @error('title')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <textarea 
                name="description"
                class="content-box" 
                placeholder="Write your content here..."
            >{{ old('content') }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit" class="submit-btn">Publish Post</button>
        </form>
    </div>

</body>
</html>