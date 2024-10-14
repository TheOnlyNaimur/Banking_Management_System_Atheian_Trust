

<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php'); // Redirect to login page if not logged in
    exit();
}

require '../Main_Bank/db_connection.php'; // Database connection


$query = "SELECT * FROM account_creation"; //Fetch all user accounts
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Accounts</title>
    <link rel="stylesheet" href="../css/style9.css">
</head>
<body>
    <header>
 
        <h1>All User Accounts</h1>
    </header>
    <main>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Account Number</th>
                <th>Account Holder Name</th>
                <th>Email</th>
                <th>Balance</th>
                <th>Date Created</th>
            </tr>
            <?php
            // Fetch and display rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['account_number']) . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . number_format($row['balance'], 2) . "</td>";
                echo "<td>" . htmlspecialchars($row['registration_time']) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <button class="btn btn--2 " type="button" onclick="window.history.back();">Go Back</button>
        <a class="btn btn--3" href="../Trust_board/admin_dashboard.php" target="_blank">Admin panel</a>
    </main>
</body>
</html>
