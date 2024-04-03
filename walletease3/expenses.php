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

    // Initialize variable to control popup display
    $showPopup = false;
    $popupMessage = "";

    // Form submission handling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape user inputs for security
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $notes = mysqli_real_escape_string($conn, $_POST['notes']);

        // Insert data into database
        $sql = "INSERT INTO user_expenses (user_id, amount, category, notes, expenses_date)
                VALUES ('$user_id', '$amount', '$category', '$notes','$date')";

        if ($conn->query($sql) === TRUE) {
            // Set flag to display success popup
            $showPopup = true;
            $popupMessage = "Expense added successfully!";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management</title>
    <style>
        /* Popup styles */
        .popup {
            display: <?php echo $showPopup ? 'block' : 'none'; ?>;
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

<!-- Popup for success message -->
<div id="successPopup" class="popup">
    <p><?php echo $popupMessage; ?></p>
</div>

<!-- Your PHP form here -->

<!-- JavaScript to hide the popup after 2 seconds -->
<script>
    setTimeout(function() {
        document.getElementById("successPopup").style.display = "none";
    }, 2000); // Popup disappears after 2 seconds
</script>

</body>
</html>
