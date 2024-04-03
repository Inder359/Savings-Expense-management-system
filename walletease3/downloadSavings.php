<?php
// Database connection
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "walletease";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get selected date from URL parameter
$selectedDate = $_GET['selected_date'];

// Run your savings query
$savings_query = "SELECT * FROM user_savings WHERE created_at = '$selectedDate'";
$result = $conn->query($savings_query);

// Generate CSV content
$csvContent = "Savings ID,Amount,Date\n";
while ($row = $result->fetch_assoc()) {
    // Append selected date to each row
    $csvContent .= $row['savings_id'] . "," . $row['amount'] . "," . $row['created_at'] . "\n";
}

// Download CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="savings.csv"');
echo $csvContent;

// Close connection
$conn->close();
?>
