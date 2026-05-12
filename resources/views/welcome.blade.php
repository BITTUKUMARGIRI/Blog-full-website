<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Site Home</title>
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
        }

        .profile-btn:hover {
            background: darkorange;
        }

        .home-container {
            min-height: calc(100vh - 70px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .box {
            width: 800px;
            max-width: 100%;
            min-height: 260px;
            display: flex;
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .section h2 {
            font-size: 30px;
            margin-bottom: 10px;
            color: #222;
        }

        .section p {
            font-size: 16px;
            color: #555;
        }

        .section:hover {
            transform: scale(1.02);
        }

        .create {
            width: 50%;
            background: #e8f5e9;
            border-right: 1px solid #ddd;
        }

        .read {
            width: 50%;
            background: #e3f2fd;
        }

        .read.full-width {
            width: 100%;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .popup {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            width: 320px;
            box-shadow: 0 0 15px rgba(16, 0, 4, 0.2);
        }

        .popup h2 {
            margin-bottom: 10px;
        }

        .popup p {
            margin-bottom: 20px;
            color: #555;
        }

        .popup button {
            margin: 8px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }

        .register-btn {
            background: green;
        }

        .login-btn {
            background: blue;
        }

        .close-btn {
            background: red;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin: 20px;
            border: 1px solid #c3e6cb;
            text-align: center;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin: 20px;
            border: 1px solid #f5c6cb;
            text-align: center;
        }

        @media (max-width: 768px) {
            .box {
                flex-direction: column;
                width: 100%;
            }
            
            .section {
                width: 100%;
                min-height: 180px;
            }
            
            .create {
                border-right: none;
                border-bottom: 1px solid #ddd;
            }
            
            .read.full-width {
                border-bottom: none;
            }
        }
    </style>
</head>
<body>
    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
    @endif

    {{-- Navbar --}}
    <div class="navbar">
        <h2>Blog Site</h2>

        @auth
            <div style="display: flex; align-items: center; gap: 12px;">
                <span>Profile: {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="profile-btn">Logout</button>
                </form>
            </div>
        @endauth

        @guest
            <button class="profile-btn" onclick="openPopup()">Profile</button>
        @endguest
          
    </div>

    {{-- Main Content --}}
    <div class="home-container">
        <div class="box">
            @auth
                @if(Auth::user()->role === 'admin')
                    {{-- Admin: Both sections side by side --}}
                    <div class="section create" onclick="window.location.href='{{ url('/create') }}'">
                        <h2>Create</h2>
                        <p>Write a new blog post</p>
                    </div>
                    <div class="section create" onclick="window.location.href='{{ url('/store') }}'">
                        <h2>add video</h2>
                        <p>UPLODE videos</p>
                    </div>
                    
                    
                    <!-- <div class="section read" onclick="window.location.href='{{ url('/read') }}'">
                        <h2>Read</h2>
                        <p>Read blog posts</p>
                    </div> -->
                 @endif
                 @endauth
                    {{-- User: Only Read, full width --}}
                    <div class="section read full-width" onclick="window.location.href='{{ url('/read') }}'">
                        <h2>Read</h2>
                        <p>Read blog posts</p>
                    </div>
                <div class="section create" onclick="window.location.href='{{ url('/video') }}'">
                        <h2>WATCH video</h2>
                        <p>Watch ALL videos</p>
                    </div>
            
        </div>
    </div>

    {{-- Guest Popup --}}
    @guest
    <div class="overlay" id="popupOverlay">
        <div class="popup">
            <h2>Profile Section</h2>
            <p>Please choose an option</p>
            <button class="register-btn" onclick="window.location.href='{{ url('/register') }}'">Register</button>
            <button class="login-btn" onclick="window.location.href='{{ url('/login') }}'">Login</button>
            <button class="close-btn" onclick="closePopup()">Close</button>
        </div>
    </div>
    @endguest

    <script>
        function openPopup() {
            document.getElementById('popupOverlay').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('popupOverlay').style.display = 'none';
        }
    </script>
</body>
</html>