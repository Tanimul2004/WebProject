<?php

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "contact_form";

$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert into database
    $query = "INSERT INTO messages (name, email, subject, message) 
              VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($conn, $query)) {
        echo "Message submitted successfully!";
        // Optionally redirect:
        // header("Location: thank-you.html");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$name = $_POST['name'];
$visitor_email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$email_from='tanim@gmail.com';
$email_subject = "New Form Submission";
$email_body = "User Name: $name.\n".
            "Your Email:  $visitor_email.\n".
            "Subject :  $subject.\n".
            "Yser Massage:  $message.\n";
$to = 'tanimul2004@gmail.com';
$headers= "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
mail($to,$email_subject,$email_body,$headers);
// echo "Thank you for contacting us!";
header("Location: contact.html");

?>