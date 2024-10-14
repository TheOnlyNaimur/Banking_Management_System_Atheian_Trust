

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch input values and by trim im removing all the whitespaces
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

//checking if admin in both password and username match!
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['admin_logged_in'] = true; // Set session variable for admin
        header('Location: admin_dashboard.php'); 
        exit();
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style8.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="admin_login.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
