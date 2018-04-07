<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/29/18
 * Time: 2:50 PM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}

# Retrieve data from the request
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$mobile_number = $_POST['mobile_number'];
$attendance = $_POST['attendance'];
$user_id = $_SESSION['id'];

// Persist guest
$query = "INSERT INTO guest (first_name, last_name, email, address, mobile_number, attendance, user_id) VALUES ('$first_name', '$last_name', '$email', '$address', '$mobile_number', '$attendance', $user_id)";
$result_insert_guest = mysqli_query($conn, $query);

// Alert and redirect
if ($result_insert_guest) {
    ?>
    <script type="text/javascript">
        alert("Guest adding succeeded.");
        window.location.replace("add-new-guest.php");
    </script>
    <?php
} else {
    ?>
    <script type="text/javascript">
        alert("Something went wrong.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
        window.location.replace("add-new-guest.php");
    </script>
    <?php
}