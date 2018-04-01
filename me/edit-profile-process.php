<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/30/18
 * Time: 11:44 AM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}

$id = $_SESSION['id'];

# Retrieve data from the request
$partner = $_POST['partner'];
$wedding_date = $_POST['wedding_date'];
$city = $_POST['city'];
$location_name = $_POST['location_name'];
$name_prefix = $_POST['name_prefix'];
$phone_number = $_POST['phone_number'];
$mailing_address = $_SESSION['mailing_address'];

// Update profile
$result_update_profile = mysqli_query($conn, "UPDATE user SET partner = '$partner', wedding_date = '$wedding_date', wedding_city = '$city', wedding_location = '$location_name', name_prefix = '$name_prefix', phone_number = '$$phone_number', mailing_address = '$mailing_address' WHERE user_id = $id");

// Alert and redirect
if ($result_update_profile) {
    ?>
    <script type="text/javascript">
        alert("Profile update succeeded.");
        window.location.replace("edit-profile.php");
    </script>
    <?php
} else {
    ?>
    <script type="text/javascript">
        alert("Something went wrong.\nYou can try again or skip for now.");
        console.log(<?php echo mysqli_error($conn); ?>)
        window.location.replace("edit-profile.php");
    </script>
    <?php
}
