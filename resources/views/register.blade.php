<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            background: linear-gradient(135deg, #43cea2, #185a9d);
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 430px;
            background: #fff;
            padding: 35px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18);
        }

        .register-container h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #222;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #43cea2;
            box-shadow: 0 0 0 3px rgba(67, 206, 162, 0.2);
        }

        .register-btn {
            width: 100%;
            padding: 12px;
            background: #43cea2;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .register-btn:hover {
            background: #2fb488;
        }

        .login-text {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
            color: #555;
        }

        .login-text a {
            color: #185a9d;
            text-decoration: none;
            font-weight: bold;
        }

        .login-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <h1>Register</h1>

        <form method="POST" action="{{ route('register') }}">
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

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Confirm Password">
            </div>

            <div class="form-group">
                <select name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                @error('name')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
                @error('email')             
                    <p style="color: red;">{{ $message }}</p>
                @enderror
                @error('phone')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
                @error('password')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="register-btn">Register</button>

            <p class="login-text">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </p>
        </form>
    </div>

</body>
</html>