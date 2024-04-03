<?php
 
 $servername = "localhost";
 $username = "root"; // Default username for XAMPP
 $password = ""; // Default password for XAMPP (empty)
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
     $email = $conn->real_escape_string($_POST['signupEmail']);
     $userpassword = $conn->real_escape_string($_POST['signupPassword']);
     $username = $conn->real_escape_string($_POST['username']);
 
     // Generate UUID
     $uuid = uniqid(); // You can use other UUID generation methods as well
 
     // Check if the email is already registered
     $check_query = "SELECT * FROM  login_data WHERE email = '$email'";
     $result = $conn->query($check_query);
     if ($result->num_rows > 0) {
         echo "This email is already registered.";
     } else {
         // Insert user data into the database with UUID
         $insert_query = "INSERT INTO  login_data (user_id, username, email, userpassword) VALUES ('$uuid', '$username', '$email', '$userpassword')";
         if ($conn->query($insert_query) === TRUE) {
            $_SESSION['uuid'] = $uuid;
             header("Location: login (2).html");
         } else {
             echo "Error: " . $insert_query . "<br>" . $conn->error;
         }
     }
 }
 
 // Close connection
 $conn->close();
 ?>
 
 