<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/12/18
 * Time: 6:22 PM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id']; // currently logged in user
// Load all settings from the request
$website_theme = $_POST['website_theme'];
// Update or insert the settings
$query = "INSERT INTO website_settings (user_id, setting, value) VALUES ($user_id, 'website.theme', '$website_theme') ON DUPLICATE KEY UPDATE value = '$website_theme';";
$result = mysqli_query($conn, $query);
if ($result) {
    ?>
    <script type="text/javascript">
        alert("Theme update succeeded.");
        window.location.replace("overview.php");
    </script>
    <?php
    die();
} else {
    ?>
    <script type="text/javascript">
        alert("Something went wrong while updating the theme.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
        window.location.replace("overview.php");
    </script>
    <?php
    die();
}