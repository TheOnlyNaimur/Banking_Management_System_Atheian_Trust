<?php
session_start(); 

if (!isset($_SESSION['account_number'])) {
    header("Location: ../Employee_account/staff_login.php");
    exit();
}

require '../Main_Bank/db_connection.php'; 

$vault_account_number = '1111111111'; // Master account number

$withdraw_status = "";
$fund_status = "";
$recipient_balance_before = 0;
$recipient_balance_after = 0;

$current_balance = 0;
$vault_result = mysqli_query($conn, "SELECT balance FROM vault WHERE bank_master_account = '$vault_account_number'");

if ($vault_result) {
    $row = mysqli_fetch_assoc($vault_result);
    $current_balance = $row['balance'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient_account = trim($_POST["recipient_account"]);
    $amount = trim($_POST["amount"]);

    if ($amount <= 0) {
        $fund_status = "Invalid withdrawal amount!";
    } else {
        $recipient_balance_query = "SELECT balance FROM account_creation WHERE account_number = '$recipient_account'";
        $recipient_result = mysqli_query($conn, $recipient_balance_query);
        $recipient_row = mysqli_fetch_assoc($recipient_result);
        $recipient_balance_before = $recipient_row ? $recipient_row['balance'] : 0;

        if (!$recipient_row) {
            $fund_status = "Recipient account does not exist!";
        } elseif ($amount > $recipient_balance_before) {
            $fund_status = "Insufficient funds in the recipient's account!";
        } else {
            $update_recipient_query = "UPDATE account_creation SET balance = balance - $amount WHERE account_number = '$recipient_account'";
            $update_vault_query = "UPDATE vault SET balance = balance + $amount WHERE bank_master_account = '$vault_account_number'";

            $recipient_updated = mysqli_query($conn, $update_recipient_query);
            $vault_updated = mysqli_query($conn, $update_vault_query);

            if ($recipient_updated && $vault_updated) {
                $withdraw_status = "Withdrawal successful!";
                $recipient_balance_after = mysqli_fetch_assoc(mysqli_query($conn, $recipient_balance_query))['balance'];

                // Log the transaction
                $employee_account_number = $_SESSION['account_number']; // Use the employee's account number
                $transaction_type = 'Withdrawal';
                $through = 'employee';
                $vault_master_account='1111111111';
                $log_transaction_query = "INSERT INTO transactions (account_number, transaction_type, amount, recipient_account, date_time, Through) VALUES ('$vault_master_account', '$transaction_type', $amount, '$recipient_account', NOW(), '$through')";
                mysqli_query($conn, $log_transaction_query);
            } else {
                $withdraw_status = "Error performing the withdrawal!";
            }
        }
    }
}

mysqli_close($conn); 
?>
