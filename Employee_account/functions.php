<?php
session_start(); 

// Check if account number is set in session
if (isset($_SESSION['account_number'])) {
    $accountNumber = $_SESSION['account_number'];
    // Unset the account number from session after fetching
    unset($_SESSION['account_number']);
} else {
    $accountNumber = "No account number found.";
}

// Check if username is set in session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Unset the username from session after fetching
    unset($_SESSION['username']);
} else {
    $username = "No Username found.";
}

// Check if password is set in session
if (isset($_SESSION['password'])) {
    $password = $_SESSION['password'];
    unset($_SESSION['password']);
} else {
    $password = "No Password provided.";
}

// Check if NID is set in session
if (isset($_SESSION['nid'])) {
    $nid = $_SESSION['nid'];
    unset($_SESSION['nid']);
} else {
    $nid = "No NID provided.";}

// Check if email is set in session
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
  unset($_SESSION['email']);
} else {
  $email = "No email provided.";
}
?>


