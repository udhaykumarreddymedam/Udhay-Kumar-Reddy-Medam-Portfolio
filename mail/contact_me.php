<?php

// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
    echo json_encode(array('error'=>'true'));
    return false;
}

$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
$phone = $_POST['phone'];
$subject = ($_POST['subject'] ? $_POST['subject'] : "Your Voice Matters: We've Received Your Message");

// 1. Send the message to your business email (udhaykumarmedam@gmail.com)
$to = 'udhaykumarmedam@gmail.com'; // Your business email address
$email_subject = "New Inquiry from: $name";
$email_body = "You have received a new message from the contact form on your website.\n\n"
            . "Here are the details:\n"
            . "Name: $name\n"
            . "Email: $email_address\n"
            . (!empty($phone) ? "Phone: $phone\n" : "")
            . "Message:\n$message\n\n";

$headers = "From: $email_address\n";  // Customer's email address as the sender
$headers .= "Reply-To: $email_address";
mail($to, $email_subject, $email_body, $headers);

// 2. Send a thank-you email back to the customer
$thank_you_subject = "Thank You for Reaching Out!";
$thank_you_body = "Dear $name,\n\n"
                . "Thank you for reaching out to us! Your input is valuable and greatly appreciated.\n\n"
                . "We have received your message and our team will get back to you shortly.\n\n"
                . "Here are the details of your message:\n\n"
                . "Name: $name\n"
                . "Email: $email_address\n"
                . (!empty($phone) ? "Phone: $phone\n" : "")
                . "Message:\n$message\n\n"
                . "Thank you for your interest and support.\n\n"    
                . "Best regards,\n"
                . "The Campaign Team";

// Send the thank-you email to the customer
$thank_you_headers = "From: udhaykumarmedam@gmail.com\n";  // Your business email address as the sender
$thank_you_headers .= "Reply-To: udhaykumarmedam@gmail.com"; 
mail($email_address, $thank_you_subject, $thank_you_body, $thank_you_headers);

echo json_encode(array('success'=>'true'));
return true;
?>
