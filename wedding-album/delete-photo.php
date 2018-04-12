<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/12/18
 * Time: 1:51 PM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id']; // current users's id
$photo_id = $_GET['id']; // id of the photo to be removed
// get the name of the photo
$query = "SELECT photo_name FROM wedding_album WHERE id = '$photo_id' AND user_id = '$user_id';";
$result_photo_name = mysqli_query($conn, $query);
if ($result_photo_name) {
    $photo = mysqli_fetch_assoc($result_photo_name);
    // Let's first delete the entry from the database
    $query_delete_photo = "DELETE FROM wedding_album WHERE id = '$photo_id'";
    $result_delete_query = mysqli_query($conn, $query_delete_photo);
    if ($result_delete_query) {
        // Let's now remove the photo from the server as well
        unlink($photo['photo_name']);
        // Let's alert the user on successful deletion and redirect
        ?>
        <script type="text/javascript">
            alert("Photo deleting succeeded.");
            window.location.replace("overview.php");
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert("Something went wrong.\nYou can try again or skip for now.");
            window.location.replace("overview.php");
        </script>
        <?php
    }
} else {
    ?>
    <script type="text/javascript">
        alert("The photo you are trying to remove can't be found in your wedding album.\nYou can try again or skip for now.");
        window.location.replace("overview.php");
    </script>
    <?php
}