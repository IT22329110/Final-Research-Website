<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP CONFIG
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'theekshanadilshan758@gmail.com';
        $mail->Password = 'huzm xumn ktox tnix'; // Gmail APP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // IMPORTANT FIX
        $mail->setFrom('theekshanadilshan758@gmail.com', 'Contact Form');
        $mail->addReplyTo($email, $name);
        $mail->addAddress('theekshanadilshan758@gmail.com');

        // EMAIL CONTENT
        $mail->isHTML(false);
        $mail->Subject = "Contact Form: " . $subject;

        $mail->Body =
            "You received a new message from your website contact form:\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Subject: $subject\n\n" .
            "Message:\n$message";

        $mail->send();

        echo "<script>
            alert('Message sent successfully!');
            window.location.href = '../pages/contact.html';
        </script>";

    } catch (Exception $e) {
        echo "<script>
            alert('Message failed: {$mail->ErrorInfo}');
            window.history.back();
        </script>";
    }
}
?>