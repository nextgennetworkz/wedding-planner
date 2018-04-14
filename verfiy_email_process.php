<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/14/18
 * Time: 6:28 PM
 */
// Db connection
include_once "config/db_connection.php";
// Let's get params from the request
$email = $_POST['email'];
$activation_code = $_POST['activation_code'];
// Let's validate the activation code
$query_validate_activation_code = "SELECT id, name, email, password FROM user_pending_verification WHERE email = '$email' AND activation_code = '$activation_code'";
$result_validate_activation_code = mysqli_query($conn, $query_validate_activation_code);
if (mysqli_num_rows($result_validate_activation_code) > 0) {
    // Let's move the user to the registered users relation
    $user = mysqli_fetch_assoc($result_validate_activation_code);
    $name = $user['name'];
    $encrypted_password = $user['password'];
    $query_insert = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$encrypted_password')";
    mysqli_query($conn, $query_insert);
    // Then delete the pending verification entry
    $id = $user['id'];
    $query_delete = "DELETE FROM user_pending_verification WHERE id = $id;";
    mysqli_query($conn, $query_delete);
    // Notify and redirect user to home page, so the user can login
    ?>
    <script type="text/javascript">
        alert("Signup succeeded.\nPlease use the login button to login to the system.");
        window.location.replace("index.php");
    </script>
    <?php
    die();
} else {
    ?>
    <script type="text/javascript">
        alert("Invalid activation code.\nPlease try again.");
        window.location.replace("verify_email.php?email=<?php echo $email; ?>");
    </script>
    <?php
    die();
}