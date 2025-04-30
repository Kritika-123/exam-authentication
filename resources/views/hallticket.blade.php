<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hall Ticket</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    body {
      font-family: 'Times New Roman', Times, serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .ticket-container {
      background: #ffffff;
      padding: 30px 40px;
      border: 2px solid #000080;
      border-radius: 6px;
      width: 700px;
      max-width: 95%;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      position: relative;
    }

    .ticket-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .ticket-header img {
      width: 80px;
      margin-bottom: 10px;
    }

    .ticket-header h2 {
      margin: 0;
      font-size: 26px;
      color: #000080;
      font-weight: bold;
      text-transform: uppercase;
    }

    .ticket-header h4 {
      margin-top: 5px;
      font-size: 16px;
      color: #333;
      font-weight: normal;
    }

    .ticket-details {
      margin-top: 20px;
      font-size: 16px;
      color: #000;
    }

    .ticket-details p {
      margin: 10px 0;
      line-height: 1.6;
    }

    .qr-section {
      text-align: center;
      margin-top: 30px;
    }

    .qr-section img {
      width: 160px;
      height: 160px;
      border: 1px solid #333;
      padding: 5px;
    }

    .note {
      margin-top: 25px;
      font-size: 14px;
      color: #555;
      text-align: center;
    }

    .divider {
      margin: 20px 0;
      border-bottom: 1px solid #ccc;
    }

    .issue-exam-dates {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
      font-size: 15px;
    }

    .signature-section {
      margin-top: 40px;
      display: flex;
      justify-content: flex-end;
      flex-direction: column;
      align-items: flex-end;
      font-size: 15px;
    }

    .signature-line {
      width: 200px;
      border-top: 1px solid #000;
      margin-top: 40px;
      text-align: center;
      font-size: 14px;
      color: #333;
    }

    .btn-group {
      text-align: center;
      margin-top: 30px;
    }

    .btn-back, .btn-download {
      display: inline-block;
      margin: 8px;
      padding: 10px 20px;
      background-color: #000080;
      color: white;
      text-decoration: none;
      border-radius: 4px;
      font-weight: bold;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }

    .btn-back:hover, .btn-download:hover {
      background-color: #002060;
    }

    @media (max-width: 600px) {
      .ticket-container {
        padding: 20px;
      }

      .ticket-header h2 {
        font-size: 22px;
      }

      .issue-exam-dates {
        flex-direction: column;
        align-items: flex-start;
      }

      .signature-section {
        align-items: center;
      }
    }
  </style>

  <script>
    function downloadPDF() {
      window.print(); 
    }
  </script>

</head>
<body>

<div class="ticket-container">
  <div class="ticket-header">
    
    <h2>Examination Hall Ticket</h2>
    <h4>Issued by Examination Authority</h4>
  </div>

  <div class="divider"></div>

  <div class="ticket-details">
    <p><strong>Candidate Name:</strong> {{ $candidate->name ?? 'Candidate Name' }}</p>
    <p><strong>Candidate ID:</strong> {{ $candidate->id ?? 'N/A' }}</p>
    <p><strong>Aadhar Number:</strong> {{ $candidate->aadhar_number ?? 'N/A' }}</p>
  </div>

  <div class="issue-exam-dates">
    <p><strong>Issue Date:</strong> {{ date('d-m-Y') }}</p>
    <p><strong>Examination Date:</strong> {{ $hallTicket->exam_date ?? 'To be announced' }}</p>
  </div>

  <div class="divider"></div>

  <div class="qr-section">
    @if($hallTicket && $hallTicket->qr_code_path)
      <p><strong>QR Code for Authentication</strong></p>
      <img src="{{ asset($hallTicket->qr_code_path) }}" alt="QR Code for {{ $candidate->name }}">
    @else
      <p style="color: red;"><strong>QR Code not available.</strong></p>
    @endif
  </div>

  <div class="signature-section">
    <div class="signature-line">Controller of Examinations</div>
  </div>

  <div class="note">
    Please carry a printed copy of this Hall Ticket along with a valid ID proof to the examination center.
  </div>

  <div class="btn-group">
    <a class="btn-back" href="/register">Back to Registration</a>
    <a class="btn-download" href="javascript:void(0)" onclick="downloadPDF()">Download PDF</a>
  </div>

</div>

</body>
</html>
