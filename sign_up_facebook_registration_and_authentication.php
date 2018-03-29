<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/24/18
 * Time: 3:28 PM
 */
// Validate if the user is logged in
include_once "config/validate_session.php";
if ($is_user_logged_in == "TRUE") {
    // Since the user is already logged in, redirect to home page
    header('Location: index.php');
}

// Db connection
include_once "config/db_connection.php";

# Retrieve data from the request
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];

// Validate the params retrieved from the POST request
if ((empty($id)) || (empty($name)) || (empty($email))) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'Internal Server Error.', 'code' => 500)));
}

# We have an active session; let's check if we've already registered the user
$result_user = mysqli_query($conn, "SELECT * FROM user WHERE name = '$name' AND email = '$email' AND oauth_uid = '$id' AND oauth_provider = 'facebook'");
$user = mysqli_fetch_array($result_user);

# If not, let's add it to the database
if (empty($user)) {
    $result_insert_user = mysqli_query($conn, "INSERT INTO user (oauth_uid, name, email, oauth_provider) VALUES ('$id', '$name', '$email', 'facebook')");
    $result_select_user = mysqli_query($conn, "SELECT * FROM user WHERE id = " . mysqli_insert_id($conn));
    $user = mysqli_fetch_array($result_select_user);

    # let's set session values
    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['oauth_uid'] = $user['oauth_uid'];
    $_SESSION['oauth_provider'] = $user['oauth_provider'];

    # Send success response
    header('Content-Type: application/json');
    print json_encode("User sign up succeeded.");
} else {
    # let's set session values even if the user is already signed in
    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['oauth_uid'] = $user['oauth_uid'];
    $_SESSION['oauth_provider'] = $user['oauth_provider'];

    # User already signed up. Let's say this to the frontend
    header('HTTP/1.1 409 Conflict');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'User already signed up.', 'code' => 409)));
}