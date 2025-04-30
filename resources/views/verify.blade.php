<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Verification </title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #002366;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .verify-container {
            background: #ffffff;
            max-width: 420px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .verify-container h2 {
            text-align: center;
            color: #002366;
            font-size: 22px;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .verify-container form input {
            width: 100%;
            padding: 10px 12px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 15px;
        }

        .verify-container form button {
            width: 100%;
            background-color: #002366;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
        }

        .verify-container form button:hover {
            background-color: #0a3d91;
        }

        .feedback {
            margin-top: 15px;
            font-size: 14px;
            text-align: center;
        }

        .error-message {
            color: #d9534f;
        }

        .success-message {
            color: #28a745;
        }

        .register-link {
            margin-top: 20px;
            text-align: center;
        }

        .register-link a {
            color: #002366;
            font-weight: 500;
            text-decoration: none;
            font-size: 14px;
        }

        .admin-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Examination Verification</h1>
    </div>

    <div class="verify-container">
        <h2>Candidate Verification</h2>

        <form id="verifyForm" method="POST" action="/verify" onsubmit="return validateForm()">
            @csrf
            <input type="text" name="aadhar_number" placeholder="Enter Aadhar Number" required>
            <input type="text" name="fingerprint_hash" placeholder="Enter Fingerprint Hash" required>
            <button type="submit">Verify</button>
        </form>

        <div id="formFeedback" class="feedback"></div>

        <div class="register-link">
            <p><a href="/register">Back to Registration</a></p>
        </div>
    </div>

    <script>
        function validateForm() {
            const aadharNumber = document.getElementsByName('aadhar_number')[0].value;
            const fingerprintHash = document.getElementsByName('fingerprint_hash')[0].value;
            const feedback = document.getElementById('formFeedback');
            feedback.innerHTML = '';

            if (!aadharNumber || !fingerprintHash) {
                feedback.innerHTML = '<p class="error-message">Both fields are required.</p>';
                return false;
            }

            feedback.innerHTML = '<p class="success-message">Submitting...</p>';
            return true;
        }
    </script>

</body>
</html>
