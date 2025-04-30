<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Candidate Registration</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: url('http://localhost/exam-auth/exam2.jpg') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      backdrop-filter: blur(6px);
    }

    .registration-container {
      background: rgba(255, 255, 255, 0.2); 
      padding: 30px 20px;
      border-radius: 18px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
      width: 90%;
      max-width: 400px;
      animation: fadeIn 1s ease forwards;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px);}
      to { opacity: 1; transform: translateY(0);}
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #ffffff;
      font-weight: 600;
      font-size: 24px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    input[type="text"],
    input[type="email"],
    input[type="file"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
      background: rgba(255, 255, 255, 0.8);
      transition: 0.3s;
    }

    input:focus {
      border-color: #3498db;
      background-color: #f0f8ff;
      outline: none;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #3498db;
      color: #ffffff;
      font-size: 15px;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #2980b9;
    }

    .admin-link {
      text-align: center;
      margin-top: 15px;
      font-size: 13px;
    }

    .admin-link a {
      color: #ffffff;
      text-decoration: underline;
    }

    #formFeedback {
      margin-top: 10px;
      font-size: 13px;
      text-align: center;
    }

    @media (max-width: 500px) {
      .registration-container {
        padding: 20px;
        max-width: 90%;
      }
    }
  </style>
</head>

<body>

<div class="registration-container">
  <h2>Candidate Registration</h2>

  <form id="registrationForm" action="{{ url('/register') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
    @csrf

    <input type="text" id="name" name="name" placeholder="Full Name" maxlength="50" required>

    <input type="text" id="aadhar_number" name="aadhar_number" placeholder="Aadhar Number" maxlength="12" required>

    <input type="text" id="fingerprint_hash" name="fingerprint_hash" placeholder="Fingerprint Hash" maxlength="40" required>

    <input type="email" id="email" name="email" placeholder="Email Address" maxlength="50" required>

    <input type="text" id="phone" name="phone" placeholder="Phone Number" maxlength="10" required>

    <input type="file" id="photo" name="photo" accept="image/*" required>

    <button type="submit">Register</button>
  </form>

  <div class="admin-link">
    <p><a href="{{ url('/admin/login') }}">Admin Login</a></p>
  </div>

  <div id="formFeedback"></div>
</div>

<script>
function validateForm() {
    const name = document.getElementById('name').value.trim();
    const aadharNumber = document.getElementById('aadhar_number').value.trim();
    const fingerprintHash = document.getElementById('fingerprint_hash').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const photo = document.getElementById('photo').files[0];
    const feedbackDiv = document.getElementById('formFeedback');

    feedbackDiv.innerHTML = '';

    if (!name || !aadharNumber || !fingerprintHash || !email || !phone || !photo) {
        feedbackDiv.innerHTML = '<p style="color:red;">Please fill all fields properly.</p>';
        return false;
    }

    if (aadharNumber.length !== 12 || !/^\d+$/.test(aadharNumber)) {
        feedbackDiv.innerHTML = '<p style="color:red;">Aadhar number must be 12 digits.</p>';
        return false;
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        feedbackDiv.innerHTML = '<p style="color:red;">Invalid email address.</p>';
        return false;
    }

    if (!/^[6-9]\d{9}$/.test(phone)) {
        feedbackDiv.innerHTML = '<p style="color:red;">Phone number must start with 6-9 and be 10 digits.</p>';
        return false;
    }

    if (!['image/jpeg', 'image/png', 'image/jpg'].includes(photo.type)) {
        feedbackDiv.innerHTML = '<p style="color:red;">Only JPG, JPEG, PNG images are allowed.</p>';
        return false;
    }

    if (photo.size > 2 * 1024 * 1024) { // 2MB
        feedbackDiv.innerHTML = '<p style="color:red;">Image size must be below 2MB.</p>';
        return false;
    }

    feedbackDiv.innerHTML = '<p style="color:green;">Submitting registration...</p>';
    return true;
}
</script>

</body>
</html>
