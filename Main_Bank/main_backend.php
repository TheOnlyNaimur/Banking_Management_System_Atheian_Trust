<?php
session_start(); // Start the session

// database connection
$conn = new mysqli('localhost', 'root', '', 'MyProject');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Retrieve form data
$username = $_POST["username"];
$password = $_POST["password"];
$nid = $_POST["nid"];
$DOB = $_POST["DOB"];
$email = $_POST["email"];

// Calculate age
list($year, $month, $day) = explode('-', $DOB);
$currentYear = date('Y');
$currentMonth = date('m');
$currentDay = date('d');

// Age calculation
$age = $currentYear - $year;
if ($currentMonth < $month || ($currentMonth == $month && $currentDay < $day)) {
    $age--; // Adjust the age if the birthday hasn't occurred this year
}

// Check if the user is 18 or older
if ($age >= 18) {
    // Check if the NID already exists in the database
    $nidQuery = "SELECT * FROM account_creation WHERE nid = '$nid'";
    $nidResult = $conn->query($nidQuery);
    
    if ($nidResult->num_rows > 0) {
    
        echo "An account with this NID already exists. Please use a different NID.";
    } else {
        // Generate a unique 10-digit account number
        do {
            $accountNumber = rand(1000000000, 8888888889); // Generate a random 10-digit number
            // Check if the account number already exists
            $accountQuery = "SELECT * FROM account_creation WHERE account_number = '$accountNumber'";
            $accountResult = $conn->query($accountQuery);
        } while ($accountResult->num_rows > 0);

        // Insert user data into the database
        $insertQuery = "INSERT INTO account_creation (username, password, nid, DOB, account_number, email) 
                        VALUES ('$username', '$password', '$nid', '$DOB', '$accountNumber', '$email')";
        if ($conn->query($insertQuery) === TRUE) {
            // Store the account number and other user details in session
            $_SESSION['account_number'] = $accountNumber;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['nid'] = $nid;
            $_SESSION['email'] = $email;

            // Redirect to results page
            header('Location: ../Main_Bank/Account_info.php');
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "You must be at least 18 years old to register.";
}

$conn->close();
?>
