<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/25/18
 * Time: 12:09 PM
 */
// Db connction
include_once "config/db_connection.php";

# Retrieve data from the request
$email = $_POST['email'];
$password = $_POST['password'];

# Validate the params retrieved from the POST request
if ((empty($email)) || (empty($password))) {
    ?>
    <script type="text/javascript">
        alert("You have left a field empty and a value must be entered.");
        window.location.replace("signup.php");
    </script>
    <?php
    exit();
}

$encrypted_password = md5($password); // Encrypt password

# Let's validate the password and log the user in if so
$result_user = mysqli_query($conn, "SELECT id, name, oauth_uid, oauth_provider FROM user WHERE email = '$email' AND password = '$encrypted_password'");
$user = mysqli_fetch_array($result_user);
if (empty($user)) {
    ?>
    <script type="text/javascript">
        alert("There was an error with your email / password combination. Please try again.");
        window.location.replace("signup.php#");
    </script>
    <?php
    exit();
}

# Successful login
# Let's set the session and redirect the user
session_start();
$_SESSION['id'] = $user['id'];
$_SESSION['name'] = $user['name'];
$_SESSION['oauth_uid'] = $user['oauth_uid'];
$_SESSION['oauth_provider'] = $user['oauth_provider'];
?>

<script type="text/javascript">
    window.location.replace("index.php");
</script>
