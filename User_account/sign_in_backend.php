<?php

session_start();


require '../Main_Bank/db_connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $account_number_signin = trim($_POST["account_number"]);
    $password_signin = trim($_POST["password"]);

    // SQL query to find the user
    $sql = "SELECT * FROM account_creation WHERE account_number = '$account_number_signin'";
    $result = mysqli_query($conn, $sql);

    // Check if the account number exists
    if ($result) {
        $row = mysqli_fetch_assoc($result); // Fetch the user data

        if ($row && $password_signin == $row['password']) {
            // Password matches, start session and redirect to user dashboard
            $_SESSION['account_number'] = $account_number_signin;
            echo "You are signed in!";
            header("Location: ../User_account/dashboard.php"); // Redirect to user dashboard
            exit();
        } else {
        
            echo "Invalid account number or password!";
        }
    } else {
        echo "Error executing query!";
    }


    mysqli_close($conn);
}
?>
