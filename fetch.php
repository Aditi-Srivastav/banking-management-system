<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-size: 24px;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px #ccc;
        }
        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td {
            color: #333;
        }
        .no-records {
            text-align: center;
            color: red;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>Customer Account Details</h1>
    <?php
        $mycon = mysqli_connect("localhost", "root", "", "banking_system");

        if (!$mycon) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM account";
        $result = mysqli_query($mycon, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Account Number</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Father's Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>PAN Card Number</th>
                    <th>Aadhar Card</th>
                    <th>Occupation</th>
                    <th>Address</th>
                    <th>Marital Status</th>
                    <th>Balance</th>
                  </tr>";
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['account_number'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['dob'] . "</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "<td>" . $row['father_name'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['pancard'] . "</td>";
                echo "<td>" . $row['aadhar'] . "</td>";
                echo "<td>" . $row['occupation'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['marital status'] . "</td>";
                echo "<td>" . $row['money'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<div class='no-records'>No records found</div>";
        }

        mysqli_close($mycon);
    ?>
</body>
</html>
