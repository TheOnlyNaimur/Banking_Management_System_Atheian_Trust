<?php 
session_start();
if (!isset($_SESSION['account_number'])) {
    echo "Wrong Account Number. Please try again";
    header("Location: ../Employee_account/staff_login.php"); // Redirect to login if not logged in
    exit();
}

?>