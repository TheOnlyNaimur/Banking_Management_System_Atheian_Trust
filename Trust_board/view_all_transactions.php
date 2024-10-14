<?php
require '../Main_Bank/db_connection.php';

// Getting all transactions from the database
$sql = "SELECT * FROM transactions ORDER BY date_time DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Transactions</title>
    <link rel="stylesheet" href="../css/style11.css">
</head>
<body>
    <header>
        <h1>All Transactions</h1>
    </header>
    <main>
        <?php
        if (mysqli_num_rows($result) > 0) {
            // Display the transactions table
            echo '<table border="1">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Account Number</th>';
            echo '<th>Transaction Type</th>';
            echo '<th>Amount</th>';
            echo '<th>Recipient Account</th>';
            echo '<th>Transaction Time</th>';
            echo '<th>Through</th>'; // New column for 'Through'
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                
                // Check if the account_number is NULL or empty and display accordingly
                $account_number = !empty($row['account_number']) ? htmlspecialchars($row['account_number']) : ''; 
                
                echo '<td>' . $account_number . '</td>';
                echo '<td>' . htmlspecialchars($row['transaction_type']) . '</td>';
                echo '<td>' . number_format($row['amount'], 2) . '</td>';
                echo '<td>' . htmlspecialchars($row['recipient_account']) . '</td>';
                echo '<td>' . htmlspecialchars($row['date_time']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Through']) . '</td>'; // Display the 'Through' column
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No transactions found.</p>';
        }
        ?>
    </main>
</body>
</html>

<?php
mysqli_close($conn); // Close the database connection
?>
