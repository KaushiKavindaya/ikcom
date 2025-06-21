<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $first_name = isset($_POST['first_name']) ? htmlspecialchars(strip_tags($_POST['first_name'])) : '';
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(strip_tags($_POST['phone'])) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars(strip_tags($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(strip_tags($_POST['message'])) : '';

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Invalid email format.');
                window.history.back();
              </script>";
        exit;
    }

    // Email details
    $to = "info@ikcom.ca"; // Replace with your email
    $email_subject = "New Message from Contact Form: $subject";
    $email_body = "You have received a new message.\n\n".
                  "Here are the details:\n".
                  "Name: $first_name\n".
                  "Email: $email\n".
                  "Phone: $phone\n".
                  "Subject: $subject\n".
                  "Message:\n$message\n";

    $headers = "From: noreply@yourdomain.com\r\n"; // Replace with your domain
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "<script>
                alert('Message sent successfully.');
                window.location.href = 'contact.html';
              </script>";
    } else {
        echo "<script>
                alert('Failed to send message. Please try again later.');
                window.history.back();
              </script>";
    }
}
?>
