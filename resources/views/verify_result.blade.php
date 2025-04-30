<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authentication Result</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, rgb(19, 47, 72), rgb(143, 197, 251));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .result-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            width: 420px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .result-container:hover {
            transform: scale(1.02);
        }

        .emoji {
            font-size: 50px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 22px;
            color: {{ $status ? '#27ae60' : '#e74c3c' }};
            margin-bottom: 20px;
        }

        .btn-back {
            display: inline-block;
            padding: 12px 24px;
            background-color: rgb(62, 119, 155);
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: rgb(84, 156, 205);
        }
    </style>
</head>
<body>

    <div class="result-container">
        <div class="emoji">{{ $status ? '✅' : '❌' }}</div>
        <h2>{{ $message }}</h2>
        <a class="btn-back" href="/verify">🔁 Try Again</a>
    </div>

</body>
</html>
