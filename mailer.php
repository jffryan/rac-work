<?php

if (isset($_POST['submit'])) {

    // Get form fields
    $name = $_POST['name'];
    $mailFrom = $_POST['email'];
    $phone = $_POST['tel'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // destination email address
    $mailTo = "dispatch@mailinator.com";
    
    // set email subject line
    $headers = "Contact From: $name";

    $email_content = "Name: $name\n";
    $email_content .= "Email: $mailFrom\n\n";
    $email_content .= "Phone: $phone\n\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    
    mail($mailTo, $subject, $email_content, $headers);

    header("Location: index.php?mailsend");

}

?>