<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Registration Successful</title>
</head>
<body>
    <h1>Dear {{ $candidate->name }},</h1>
    <p>Your registration is successful!</p>
    <p>Your hall ticket QR code is attached below:</p>
    <img src="{{ public_path($qrCodePath) }}" alt="QR Code">
    <p>Thank you for registering!</p>
</body>
</html>
