<?php
session_start();
// if (!isset($_SESSION['admin_id'])) {
//     die("Unauthorized access");
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'banking_system');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($action === 'approve') {
        // Approve the request and update user credentials
        $query = "UPDATE account u
                  JOIN credential_requests cr ON u.account_number = cr.user_id
                  SET u.username = COALESCE(cr.requested_username, u.username),
                    --   u.email = COALESCE(cr.requested_email, u.email),
                      u.password = COALESCE(cr.requested_password, u.password)
                  WHERE cr.id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $request_id);

        if ($stmt->execute()) {
            $update_status = "UPDATE credential_requests SET status = 'approved' WHERE id = ?";
            $update_stmt = $conn->prepare($update_status);
            $update_stmt->bind_param("i", $request_id);
            $update_stmt->execute();
            echo "Request approved successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
    } elseif ($action === 'reject') {
        // Reject the request
        $query = "UPDATE credential_requests SET status = 'rejected' WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $request_id);

        if ($stmt->execute()) {
            echo "Request rejected successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
