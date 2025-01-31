<?php
// Check for empty fields
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) ||!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400); // Return a 400 Bad Request status code
    echo "No arguments Provided!";
    exit; // Stop executing the script
}

// Sanitize and validate input data
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email_address = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'essage', FILTER_SANITIZE_STRING);

// Create the email and send the message
$to = 'sauravsahu31@gmaail.com'; // Replace with your email address
$email_subject = "Website Contact Form: $name";
$email_body = "You have received a new message from your website contact form.\n\n".
    "Here are the details:\n\n".
    "Name: $name\n\n".
    "Email: $email_address\n\n";
if (!empty($phone)) {
    $email_body.= "Phone: $phone\n\n";
}
$email_body.= "Message:\n$message";
$headers = "From: sauravsahu31@gmaail.com\n"; // Replace with your email address
$headers.= "Reply-To: $email_address";

if (mail($to, $email_subject, $email_body, $headers)) {
    http_response_code(200); // Return a 200 OK status code
    echo "Message sent successfully!";
} else {
    http_response_code(500); // Return a 500 Internal Server Error status code
    echo "Error sending message!";
}