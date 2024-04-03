<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit; // Ensure no further code execution after redirect

}
// Retrieve user ID from session
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

// Password update query
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {
    // Redirect to the change password page
    header("Location: change_password.html");
    exit; // It's good practice to exit after a header redirection to prevent further execution
}

// Update name query
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_name'])) {
    $update_name = $_POST["update_name"];
    $sql = "UPDATE login_data SET username = '$update_name' WHERE user_id = $user_id";
    if ($conn->query($sql) === TRUE) {
        echo "Name updated successfully";
    } else {
        echo "Error updating name: " . $conn->error;
    }
}

// Update email query 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_email'])) {
    $update_email = $_POST["update_email"];
    $sql = "UPDATE login_data SET email = '$update_email' WHERE user_id = $user_id";
    if ($conn->query($sql) === TRUE) {
        echo "Email updated successfully";
    } else {
        echo "Error updating email: " . $conn->error;
    }
}

// Logout query 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.html');
    exit;
}

$conn->close();
?>