

<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style9.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
    <main class="dashboard-container">
        <!-- Button all user accounts -->
        <a href="../Trust_board/view_accounts.php" class="dashboard-button">View All User Accounts</a>
        
        <!-- Button all transactions -->
        <a href="../Trust_board/view_all_transactions.php" class="dashboard-button">View All Transactions</a>
        


        <!-- Log Out Button -->
        <a href="../Trust_board/admin_logout.php" class="dashboard-button logout">Log Out</a>
    </main>
</body>
</html>
