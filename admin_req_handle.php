<?php
session_start();
// Check if admin is logged in
// if (!isset($_SESSION['admin_id'])) {
//     die("Unauthorized access");
// }
if ($_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit();
}
// Database connection
$conn = new mysqli('localhost', 'root', '', 'banking_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT cr.id, u.username AS current_username,  cr.requested_username, cr.status
          FROM credential_requests cr
          JOIN account u ON cr.user_id = u.account_number
          WHERE cr.status = 'pending'";

$result = $conn->query($query);
?>

<table border="1">
    <tr>
        <th>Request ID</th>
        <th>Current Username</th>
        <!-- <th>Current Email</th> -->
        <th>Requested Username</th>
        <!-- <th>Requested Email</th> -->
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['current_username']; ?></td>
        <td><?php echo $row['requested_username']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>
            <form method="POST" action="approve_request.php">
                <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="action" value="approve">Approve</button>
                <button type="submit" name="action" value="reject">Reject</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>
<?php
$conn->close();
?>
