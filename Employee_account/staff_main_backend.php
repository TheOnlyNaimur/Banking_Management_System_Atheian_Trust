<?php
session_start(); 

require '../Main_Bank/db_connection.php'; 

$username = $_POST["username"];
$password = $_POST["password"];
$nid = $_POST["nid"];
$DOB = $_POST["DOB"];
$email = $_POST["email"];

// Calculate age by extracting year, month, and day
list($year, $month, $day) = explode('-', $DOB);
$currentYear = date('Y'); // Current year
$currentMonth = date('m'); // Current month
$currentDay = date('d'); // Current day

// age calculation
$age = $currentYear - $year;

// Adjust the age if the birthday hasn't occurred this year
if ($currentMonth < $month || ($currentMonth == $month && $currentDay < $day)) {
    $age--;
}

// Check if the user is 18 or older
if ($age >= 18) {
    
    $conn = mysqli_connect('localhost', 'root', '', 'MyProject');

    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    } else {
        // Check if the NID already exists in the database
        $checkNidQuery = "SELECT COUNT(*) as count FROM employee_account WHERE nid = '$nid'";
        $resultNid = mysqli_query($conn, $checkNidQuery);
        $rowNid = mysqli_fetch_assoc($resultNid);

        if ($rowNid['count'] > 0) {
            // NID already exists
            echo "An account with this NID already exists. Please use a different NID.";
        } else {
            // Generate a unique random 10-digit account number
            do {
                $accountNumber = rand(8000000000, 9999999999); // Generate a random 10-digit number
                
                // Check if the account number already exists in the database
                $checkQuery = "SELECT COUNT(*) as count FROM employee_account WHERE account_number = '$accountNumber'";
                $result = mysqli_query($conn, $checkQuery);
                $row = mysqli_fetch_assoc($result);
            } while ($row['count'] > 0); // Continue generating until a unique number is found

            // Insert user data and account number
            $insertQuery = "INSERT INTO employee_account (username, password, nid, DOB, account_number, email) VALUES ('$username', '$password', '$nid', '$DOB', '$accountNumber', '$email')";
            $insertResult = mysqli_query($conn, $insertQuery);

            if ($insertResult) {
                // Store the account number and other user details in session
                $_SESSION['account_number'] = $accountNumber;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['nid'] = $nid;
                $_SESSION['email'] = $email;

                
                header('Location: ../Employee_account/staff_account_info.php');
                exit;
            } else {
                echo "Failed to insert user data into the database.";
            }
        }

        mysqli_close($conn); 
    }
} else {
    echo "You must be at least 18 years old to register.";
}
?>
