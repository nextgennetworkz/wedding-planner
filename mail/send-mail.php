<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/7/18
 * Time: 1:32 PM
 */
/* A simple php to send emails */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}

# Retrieve data from the request
$selected_guests = $_POST['selected_guests'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// send email
foreach ($selected_guests as $guest)
    mail($guest, $subject, $message);

// Finally, redirect to overview page
header("Location: /wedding-planner/your-guests/overview.php");
die();
