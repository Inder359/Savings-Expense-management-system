<?php
session_start();

// Check if user is logged in and retrieve session variable
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

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
        $monthlyIncome = mysqli_real_escape_string($conn, $_POST['monthlyIncome']);
        $monthlyBudget = mysqli_real_escape_string($conn, $_POST['monthlyBudget']);
        $budgetMonth = mysqli_real_escape_string($conn, $_POST['budgetMonth']);
        

        // Insert data into database
        $sql = "INSERT INTO user_income (user_id, monthlyIncome,monthlyBudget,budgetMonth)
        VALUES ('$user_id', '$monthlyIncome', '$monthlyBudget', '$budgetMonth')";

        if ($conn->query($sql) === TRUE) {
          
             
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close connection
    $conn->close();
} else {
    
    header("Location: login (2).html");
    exit;
}
?>
