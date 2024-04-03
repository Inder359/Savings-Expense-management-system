<?php
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $to = $_POST["email"];
    
    $subject = "Password Reset Request";
    $message = "Hello user\n \n";
    $message .= "You have requested a password reset. Please click on the following link to reset your password:\n \n";
    $message .=  "http://F:/xampp/htdocs/walletease3/change_password.html \n";
    $message .= " \nIf you did not request a password reset, please ignore this email.\n\n";
    $message .= "Regards,\nWalletease Website Team";

	 
    $from = "inderkumarmaurya359@gmail.com";
    $headers = "From: $from";
    if (mail($to, $subject, $message, $headers)) {
       
        echo "Email Sent Successfully! to \n $to";
    } else {
        echo "Email NOT Sent.";
    }

}
?>