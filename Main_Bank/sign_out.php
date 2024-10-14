<?php

session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location: ../User_account/sign_in.php"); 
exit();
?>
