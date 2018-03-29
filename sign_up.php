<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/24/18
 * Time: 8:11 PM
 */
// Db connction
include_once "config/db_connection.php";

# Retrieve data from the request
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

# Validate the params retrieved from the POST request
if ((empty($name)) || (empty($email)) || (empty($password))) {
    ?>
    <script type="text/javascript">
        alert("You have left a field empty and a value must be entered.");
        window.location.replace("signup.php");
    </script>
    <?php
    exit();
}

$encrypted_password = md5($password); // Encrypt password

# If a user has already signed up with the same email, alert the new user and abort the registration
$result_user = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
$user = mysqli_fetch_array($result_user);
if (!empty($user)) {
    ?>
    <script type="text/javascript">
        alert("There is already a user with this email. Please try another.");
        window.location.replace("signup.php");
    </script>
    <?php
    exit();
}

# Let's insert the user into the Db
$result_insert_user = mysqli_query($conn, "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$encrypted_password')");
if (empty($result_insert_user)) {
    ?>
    <script type="text/javascript">
        alert("Something went wrong.\nYou can try again or skip for now.");
        window.location.replace("signup.php");
    </script>
    <?php
    exit();
}
?>

<!-- Redirect to login page, so the user can login to the newly created account -->
<script type="text/javascript">
    alert("Sign up succeeded.\nPlease login to continue.");
    window.location.replace("signup.php#");
</script>
