<?php
session_start();
// if (!isset($_SESSION['user_id'])) {
//     die("Unauthorized access");
// }
if ($_SESSION['role'] != 'user') {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $user_id = $_SESSION['user_id'];
    $user_id = $_SESSION['acc_num'];
    $requested_username = $_POST['username'] ?? null;
    // $requested_email = $_POST['email'] ?? null;
    $requested_password = password_hash($_POST['password'], PASSWORD_BCRYPT) ?? null;

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'banking_system');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO credential_requests (user_id, requested_username, requested_password) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $requested_username, $requested_password);

    if ($stmt->execute()) {
        echo "Credential update request submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<form method="POST">
    <label>New Username: <input type="text" name="username"></label><br>
    <!-- <label>New Email: <input type="email" name="email"></label><br> -->
    <label>New Password: <input type="password" name="password"></label><br>
    <button type="submit">Submit Request</button>
</form>
