<?php
session_start();

// Check if user is logged in and retrieve session variable
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    if (!isset($_SESSION['user_id'])) {


        header("Location: login (2).html"); // Redirect to login page if not logged in
        exit;
    
    }
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

    // Form submission handling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape user inputs for security
        $savingsAmount = mysqli_real_escape_string($conn, $_POST['savingsAmount']);
        $savingsType = mysqli_real_escape_string($conn, $_POST['savingsType']);
        $savingsTime = mysqli_real_escape_string($conn, $_POST['savingsTime']);
        $interestRate = mysqli_real_escape_string($conn, $_POST['interestRate']);

        // Insert data into database
        $sql = "INSERT INTO user_savings (user_id, savings_amount,savings_type,savings_time,interest_rate)
        VALUES ('$user_id', '$savingsAmount', '$savingsType', '$savingsTime','$interestRate')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close connection
    $conn->close();
}  
?>
