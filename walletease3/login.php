 <?php
 
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "walletease"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query to check if the email and password match
    $query = "SELECT * FROM login_data WHERE email = '$email' AND userpassword = '$password'";
    $result = $conn->query($query);

    session_start(); // Start the session

if ($result->num_rows > 0) {
    // Assuming $user_id is retrieved from the database query result
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];

    // Store user ID in the session variable
    $_SESSION['user_id'] = $user_id;

    // Redirect to main.html if the email and password match
    header("Location: main.html");
    exit(); // Ensure no further code execution after redirect
} else {
        // Display error message if no matching record is found
        echo "Incorrect email or password.";
    }
}

// Close connection
$conn->close();
?>
