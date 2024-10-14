<?php
session_start();

if (!isset($_SESSION['account_number'])) {
    header("Location: ../Employee_account/staff_login.php");
    exit();
}

require '../Main_Bank/db_connection.php';

$vault_master_account = '1111111111';

$deposit_status = "";
$fund_status = "";

function getVaultBalance($conn, $vault_master_account) {
    $sql = "SELECT balance FROM vault WHERE bank_master_account = '$vault_master_account'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['balance'];
    } else {
        return 0;
    }
}

$current_balance = getVaultBalance($conn, $vault_master_account);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient_account = trim($_POST["recipient_account"]);
    $amount = trim($_POST["amount"]);

    if ($amount <= 0) {
        $fund_status = "Invalid deposit amount!";
    } elseif ($amount > $current_balance) {
        $fund_status = "Insufficient funds in the vault!";
    } else {
        $sql = "SELECT balance FROM account_creation WHERE account_number = '$recipient_account'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $sql_update_vault = "UPDATE vault SET balance = balance - $amount WHERE bank_master_account = '$vault_master_account'";
            mysqli_query($conn, $sql_update_vault);

            $sql_update_recipient = "UPDATE account_creation SET balance = balance + $amount WHERE account_number = '$recipient_account'";
            mysqli_query($conn, $sql_update_recipient);

            $current_balance = getVaultBalance($conn, $vault_master_account);
            $deposit_status = "Deposit successful!";

            // Log the transaction
            $employee_account_number = $_SESSION['account_number']; // Use the employee's account number
            $through = 'employee';
            $vault_master_account = '1111111111';
            $sql_log = "INSERT INTO transactions (account_number, transaction_type, amount, recipient_account, date_time, Through) VALUES ('$vault_master_account', 'Deposit', $amount, '$recipient_account', NOW(), '$through')";
            mysqli_query($conn, $sql_log);
        } else {
            $fund_status = "Recipient account does not exist!";
        }
    }
}

mysqli_close($conn);
?>
