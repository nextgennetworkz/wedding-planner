<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/24/18
 * Time: 5:44 PM
 */
# Db connection
include_once "db_connection.php";

$is_user_logged_in = "FALSE"; // To be used as a global variable to track if the user is logged in

session_start();

# Authenticate a user who is already logged in
if (!empty($_SESSION)) {
    if ((!empty($_SESSION['id'])) && (!empty($_SESSION['name']))) {
        $id = $_SESSION['id'];
        $name = $_SESSION['name'];
        $oauth_uid = $_SESSION['oauth_uid'];
        $oauth_provider = $_SESSION['oauth_provider'];

        # We have an active session; let's validate session details against the Db
        $result_user = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id' AND name = '$name'");
        $user = mysqli_fetch_array($result_user);

        if (!empty($user)) {
            $is_user_logged_in = "TRUE";
        }
    }
}