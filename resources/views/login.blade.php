<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 35px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .success-msg {
            color: green;
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.2);
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: #4facfe;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #2f8ef5;
        }

        .register-text {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
            color: #555;
        }

        .register-text a {
            color: #4facfe;
            text-decoration: none;
            font-weight: bold;
        }

        .register-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>Login</h1>

        @if(session('success'))
            <p class="success-msg">{{ session('success') }}</p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <input type="tel" name="phone" placeholder="Phone" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password">
            </div>

            <button type="submit" class="login-btn">Login</button>

            <p class="register-text">
                Don't have an account?
                <a href="{{ route('register') }}">Register</a>
            </p>
        </form>
    </div>

</body>
</html>