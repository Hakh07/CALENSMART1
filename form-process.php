<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $eventDate = sanitize_input($_POST['eventDate']);
    $eventTitle = sanitize_input($_POST['event']);
    $eventDescription = sanitize_input($_POST['description']);
    $eventLocation = sanitize_input($_POST['location']);
    $participantEmail = sanitize_input($_POST['email']);

    // Simple form validation
    if (empty($eventDate) || empty($eventTitle) || empty($eventDescription) || empty($eventLocation) || empty($participantEmail)) {
        // Handle error - One or more fields are empty
        echo "Please fill in all required fields.";
    } else {
        // Email Content
        $email_subject = "New Event Registration: " . $eventTitle;
        $email_body = "You have received a new event registration.\n\n";
        $email_body .= "Event Date: " . $eventDate . "\n";
        $email_body .= "Event Title: " . $eventTitle . "\n";
        $email_body .= "Event Description: " . $eventDescription . "\n";
        $email_body .= "Event Location: " . $eventLocation . "\n";
        $email_body .= "Participant Email: " . $participantEmail . "\n";

        // Send Email
        $to = "humza12anwar@gmail.com"; // Replace with your email address
        $headers = "From: " . $participantEmail; // Consider a valid From address
        $mail_success = mail($to, $email_subject, $email_body, $headers);

        if ($mail_success) {
            echo "Thank you for your submission!";
        } else {
            echo "Mail sending failed.";
        }
    }
} else {
    // Not a POST request, redirect to the form page
    header('Location: invitation-form.html'); // Replace with your HTML file name
    exit;
}

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
