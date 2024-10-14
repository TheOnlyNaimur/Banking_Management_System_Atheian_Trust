<?php

session_start();


require '../Main_Bank/db_connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the account number and password
    $account_number_signin = trim($_POST["account_number"]);
    $password_signin = trim($_POST["password"]);

    // SQL query to find the user in the employee_account table
    $sql = "SELECT * FROM employee_account WHERE account_number = '$account_number_signin'";
    $result = mysqli_query($conn, $sql);

    // Check if the account number exists
    if ($result) {
        $row = mysqli_fetch_assoc($result); // Fetch the user data


        ////////////// Debugging: Output fetched password and input password////////////////////////////////////////
        echo "Stored Password: " . htmlspecialchars($row['password']) . "<br>";
        echo "Input Password: " . htmlspecialchars($password_signin) . "<br>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////



        // Check if the user is found and the passwords match
        if ($row && $password_signin == $row['password']) {
            
            $_SESSION['account_number'] = $account_number_signin;
            echo "You are signed in!";
            header("Location: ../Employee_account/staff_dashboard.php"); // Redirect to the staff dashboard
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
