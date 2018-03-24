<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/24/18
 * Time: 3:28 PM
 */
// Validate if the user is logged in
include_once "config/validate_session.php";
if ($is_user_logged_in) {
    // Since the user is already signed up, redirect to home page
    header('Location: index.php');
}

// Db connection
include_once "config/db_connection.php";

# Retrieve data from the request
$id = $_POST['id'];
$name = $_POST['name'];

# We have an active session; let's check if we've already registered the user
$result_user = mysqli_query($conn, "SELECT * FROM user WHERE oauth_uid = '$id' AND name = '$name' AND oauth_provider = 'facebook'");
$user = mysqli_fetch_array($result_user);

# If not, let's add it to the database
if (empty($user)) {
    $result_insert_user = mysqli_query($conn, "INSERT INTO user (oauth_uid, name, oauth_provider) VALUES ('$id', '$name', 'facebook')");
    $result_select_user = msyql_query($conn, "SELECT id, name, oauth_uid, oauth_provider FROM user WHERE id = " . mysqli_insert_id());
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
    # User already signed up. Let's ask to sign in
    header('HTTP/1.1 409 Conflict');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'User already signed up.', 'code' => 409)));
}