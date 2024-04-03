<?php
session_start();

// Check if user is logged in
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

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the new password and confirm password fields are set
        if (isset($_POST["new_password"]) && isset($_POST["confirm_password"])) {

            $new_password = $_POST["new_password"];
            $confirm_password = $_POST["confirm_password"];

            // Check if new password and confirm password match
            if ($new_password === $confirm_password) {

                // Hash the new password
                 
                // Update password in the database
                $sql = "UPDATE login_data SET userpassword = '$confirm_password' WHERE user_id = $user_id";
                $result = $conn->query($sql);

                if ($result) {
                    // Password changed successfully
                    echo "Password changed successfully!";
                } else {
                    // Error updating password
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                // Passwords do not match, display an error message
                echo "Passwords do not match!";
            }
        } else {
            // Fields not set, display an error message
            echo "Please fill out all the fields!";
        }
    }
} else {
    // User not logged in, redirect or display appropriate message
    header("Location: login.php");
    exit;
}

// Close the database connection
$conn->close();
?>
