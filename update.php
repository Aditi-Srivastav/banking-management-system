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
    <title>Update Customer Record</title>
</head>
<body>
    <h1>Update Customer Record</h1>
    <form action="update.php" method="POST">
        <label for="account_number">Account Number:</label>
        <input type="text" name="account_number" id="account_number" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" placeholder="Leave blank if no change"><br><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" id="dob" placeholder="Leave blank if no change"><br><br>

        <label for="occupation">Occupation:</label>
        <input type="text" name="occupation" id="occupation" placeholder="Leave blank if no change"><br><br>

        <label for="pancard">PAN Card:</label>
        <input type="text" name="pancard" id="pancard" placeholder="Leave blank if no change"><br><br>

        <label for="aadhar">Aadhar:</label>
        <input type="text" name="aadhar" id="aadhar" placeholder="Leave blank if no change"><br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" placeholder="Leave blank if no change"><br><br>

        <label for="marital_status">Marital Status:</label>
                <select id="maritalstatus" name="marital_status" >
                    <option value="">Leave blank if no change </option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                </select><br><br>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="Leave blank if no change"><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Leave blank if no change"><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Leave blank if no change"><br><br>

        <button type="submit" name="btnsubmit">Update</button>
    </form>
</body>


<?php
if(isset($_POST['btnsubmit']))
{
// Database connection
$host = "localhost";  // Replace with your host
$username = "root";   // Replace with your username
$password = "";       // Replace with your password
$database = "banking_system"; // Replace with your database name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $account_number = $_POST['account_number'] ?? '';

    // Collect fields from POST request using null coalescing operator
    $phone = $_POST['phone'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $occupation = $_POST['occupation'] ?? '';
    $pancard = $_POST['pancard'] ?? '';
    $aadhar = $_POST['aadhar'] ?? '';
    $address = $_POST['address'] ?? '';
    $marital_status = $_POST['marital_status'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    // Hash the password only if it's provided
    $hashed_password = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

    $fields = [
        'phone' => $phone,
        'dob' => $dob,
        'occupation' => $occupation,
        'pancard' => $pancard,
        'aadhar' => $aadhar,
        'address' => $address,
        'marital_status' => $marital_status,
        'username' => $username,
        'password' => $hashed_password,
        'email' => $email
    ];

    // Check if account exists
    $check_query = "SELECT * FROM account WHERE account_number = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $account_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Build the update query dynamically
        $update_query = "UPDATE account SET ";
        $update_fields = [];
        $params = [];
        $types = "";

        foreach ($fields as $column => $value) {
            if (!empty($value)) {
                $update_fields[] = "$column = ?";
                $params[] = $value;
                $types .= "s";
            }
        }

        if (!empty($update_fields)) {
            $update_query .= implode(", ", $update_fields) . " WHERE account_number = ?";
            $params[] = $account_number;
            $types .= "s";

            $stmt = $conn->prepare($update_query);
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                echo "Customer record updated successfully.";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "No fields to update.";
        }
    } else {
        echo "Account not found.";
    }

    $stmt->close();
}

$conn->close();
}
?>

</html>