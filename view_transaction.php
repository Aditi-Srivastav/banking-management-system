<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit();
}
?>
<?php 
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$dbname = "banking_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch transactions
$sql = "SELECT m.id, m.account_number, m.transaction_type, m.amount,m.prev_balance, m.transaction_date, m.new_balance, a.money
        FROM daybook_table m
        JOIN account a ON m.account_number = a.account_number
        ORDER BY m.transaction_date DESC";
$result = $conn->query($sql);

// CSS for table styling
echo "
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 20px;
    }

    h1 {
        text-align: center;
        color: #004080;
        margin-bottom: 20px;
    }

    table {
        width: 90%;
        margin: 0 auto;
        border-collapse: collapse;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    th, td {
        text-align: left;
        padding: 10px;
    }

    th {
        background-color: #004080;
        color: white;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:nth-child(odd) {
        background-color: #ffffff;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    td {
        border-bottom: 1px solid #ddd;
    }

    caption {
        margin-bottom: 15px;
        font-size: 1.5em;
        color: #333;
    }
</style>
";

echo "<h1>Transaction Records</h1>";

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Account Number</th>
                <th>Transaction Type</th>
                <th>Amount</th>
                <th>Transaction Date</th>
                <th>Previous Balance</th>
                <th>Available Balance</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["account_number"] . "</td>
                <td>" . ucfirst($row["transaction_type"]) . "</td>
                <td>₹" . number_format($row["amount"], 2) . "</td>
                <td>" . $row["transaction_date"] . "</td>
                <td>₹" . number_format($row["prev_balance"], 2) . "</td>
                <td>₹" . number_format($row["new_balance"], 2) . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center; color: #555;'>No transactions found.</p>";
}

$conn->close();
?>
