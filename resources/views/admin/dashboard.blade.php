<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Ensure the image path is correct and the extension is .jpg if it's a .jpg image */
            background: url('http://localhost/exam-auth/exam1.png') no-repeat center center fixed; /* Adjust path to the image if necessary */
            background-size: cover;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 85%;
            margin: 40px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.8); /* Added transparency to make content visible over background */
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .header h2 {
            color:rgb(21, 71, 104);
            font-size: 32px;
            font-weight: bold;
        }

        .header .logout a {
            padding: 12px 30px;
            background-color:rgb(251, 140, 127);
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 8px;
            transition: 0.3s ease-in-out;
        }

        .header .logout a:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

        /* Search Bar */
        .search-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-input {
            padding: 12px 20px;
            width: 70%;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            outline: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease;
        }

        .search-input:focus {
            border-color: #3498db;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.5);
        }

        .search-btn {
            padding: 12px 20px;
            background-color:rgba(92, 176, 240, 0.56);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        .search-btn:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            font-size: 14px;
            color: #555;
        }

        th {
            background-color:rgb(31, 85, 121);
            color: white;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ecf0f1;
            transform: scale(1.02);
            transition: 0.3s ease;
        }

        .view-btn {
            padding: 8px 15px;
            background-color:rgb(106, 178, 251);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .view-btn:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .search-input {
                width: 100%;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 10px;
            }

            .header .logout a {
                padding: 10px 20px;
                font-size: 14px;
            }

            .search-btn {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h2>Admin Dashboard</h2>
            <div class="logout">
                <a href="/admin/logout">Logout</a>
            </div>
        </div>

        <!-- Search Section -->
        <div class="search-container">
            <input type="text" id="search" class="search-input" placeholder="Search by Name or Aadhar" onkeyup="searchTable()">
            <button class="search-btn" onclick="searchTable()">Search</button>
        </div>

        <!-- Table Section -->
        <table id="candidatesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Aadhar Number</th>
                    <th>Fingerprint</th>
                    <th>Hall Ticket</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidates as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->aadhar_number }}</td>
                        <td>{{ $c->fingerprint_hash }}</td>
                        <td><a href="/hallticket/{{ $c->id }}" target="_blank" class="view-btn">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Search Table Functionality
        function searchTable() {
            let input = document.getElementById('search');
            let filter = input.value.toUpperCase();
            let table = document.getElementById('candidatesTable');
            let tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let tdName = tr[i].getElementsByTagName('td')[1];
                let tdAadhar = tr[i].getElementsByTagName('td')[2];

                if (tdName || tdAadhar) {
                    let nameText = tdName.textContent || tdName.innerText;
                    let aadharText = tdAadhar.textContent || tdAadhar.innerText;

                    if (nameText.toUpperCase().indexOf(filter) > -1 || aadharText.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>
</html>
