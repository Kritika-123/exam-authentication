<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: rgb(0, 27, 53);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #fff;
            padding: 40px 30px;
            width: 380px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease;
            text-align: center;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        h2 {
            margin-bottom: 30px;
            font-size: 26px;
            color: #2c3e50;
        }

        .input-group {
            position: relative;
            margin: 20px 0;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 14px 12px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
            background: #f9f9f9;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #2980b9;
            background: #eef1f8;
        }

        label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            background: white;
            padding: 0 4px;
            color: #aaa;
            font-size: 16px;
            transition: 0.3s;
            pointer-events: none;
        }

        input:focus + label,
        input:not(:placeholder-shown) + label {
            top: 0;
            left: 10px;
            font-size: 12px;
            color: #2980b9;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 16px;
            color: #888;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #1c6fa6;
            transform: translateY(-2px);
        }

        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .login-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Admin Login</h2>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/admin/login" onsubmit="return validateForm()">
            @csrf

            <div class="input-group">
                <input type="text" id="username" name="username" required placeholder=" " />
                <label for="username">Username</label>
            </div>

            <div class="input-group">
                <input type="password" id="password" name="password" required placeholder=" " />
                <label for="password">Password</label>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggle = document.querySelector('.toggle-password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggle.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggle.textContent = '👁️';
            }
        }

        function validateForm() {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            if (username === "" || password === "") {
                alert('Please fill in all fields.');
                return false;
            }

            if (password.length < 6) {
                alert('Password must be at least 6 characters.');
                return false;
            }

            return true;
        }
    </script>

</body>
</html>
