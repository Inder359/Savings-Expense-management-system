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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $expenses_date = $_POST['expenses_date'];

    // Insert data into database
    $sql = "INSERT INTO user_expenses (category, amount, expenses_date) VALUES ('$category', '$amount', '$expenses_date')";

    if ($conn->query($sql) === TRUE) {
        // Expense added successfully, set a flag to display the success popup
        $showSuccessPopup = true;
    } else {
        // Error adding expense
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management</title>
    <style>
        /* Popup styles */
        .popup {
            display: <?php echo isset($showSuccessPopup) && $showSuccessPopup ? 'block' : 'none'; ?>;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
    </style>
</head>
<body>

<!-- Your HTML content here -->

<!-- Success Popup -->
<div class="popup">
    <p>Expense added successfully!</p>
</div>

<!-- Your PHP form here -->

</body>
</html>
