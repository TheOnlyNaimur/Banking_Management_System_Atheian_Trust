<?php 
session_start();
if (!isset($_SESSION['account_number'])) {
    echo "Wrong Account Number. Please try again";
    header("Location: ../User_account/sign_in.php"); // Redirect to login if not logged in
    exit();
}

?>