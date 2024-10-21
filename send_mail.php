<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(strip_tags(trim($_POST['Name'])));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $number = htmlspecialchars(strip_tags(trim($_POST['number'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    $to = "info@atlaspharma.lk";
    $subject = "New Contact Form Submission from $name";
    $body = "Name: $name\nEmail: $email\nNumber: $number\nMessage:\n$message";
    
    // Additional headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email and handle errors
    if (mail($to, $subject, $body, $headers)) {
        echo "Email successfully sent!";
    } else {
        error_log("Mail sending failed for $email", 0);
        echo "Failed to send email. Please try again later.";
    }
}
?>