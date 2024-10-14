<?php
session_start();

if (!isset($_SESSION['account_number'])) {
    header("Location: ../User_account/sign_in.php");
    exit();
}

require '../Main_Bank/db_connection.php';

$account_number = $_SESSION['account_number'];

$transfer_status = "";
$fund_status = "";
$recipient_status = ""; 

// Fetch the current balance for the user
$result = mysqli_query($conn, "SELECT balance FROM account_creation WHERE account_number = '$account_number'");
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $current_balance = $row['balance'];
} else {
    $fund_status = "Error fetching current balance or account does not exist.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient_account = $_POST["recipient_account"];
    $amount = $_POST["amount"];

    // Check if the recipient account exists
    $recipient_result = mysqli_query($conn, "SELECT * FROM account_creation WHERE account_number = '$recipient_account'");

    if (mysqli_num_rows($recipient_result) > 0) {
        if ($amount > 0 && $amount <= $current_balance) {
            // Deduct from sender's account
            $deduct_sender = mysqli_query($conn, "UPDATE account_creation SET balance = balance - $amount WHERE account_number = '$account_number'");
            // Add to recipient's account
            $add_recipient = mysqli_query($conn, "UPDATE account_creation SET balance = balance + $amount WHERE account_number = '$recipient_account'");
            // Log the transaction with "Through" set as "user"
            $through = 'user';
            $record_transaction = mysqli_query($conn, "INSERT INTO transactions (account_number, transaction_type, amount, recipient_account, Through) VALUES ('$account_number', 'Transfer', $amount, '$recipient_account', '$through')");

            if ($deduct_sender && $add_recipient && $record_transaction) {
                $transfer_status = "Transfer successful!";
                $current_balance -= $amount;
            } else {
                $transfer_status = "Error during transfer. Please try again.";
            }
        } else {
            $fund_status = "Invalid amount or insufficient funds!";
        }
    } else {
        $recipient_status = "Recipient account does not exist!";
    }
}

mysqli_close($conn);
?>
