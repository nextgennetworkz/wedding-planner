<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/14/18
 * Time: 8:12 AM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id']; // id of the current user
// Let's fetch parameters from the request
$url = $_POST['url'];
// If the request has a foreign_inventory_id, then its an update requests
// Else its a insert
if (!empty($_POST['foreign_inventory_id'])) {
    $foreign_inventory_id = $_POST['foreign_inventory_id'];
    $query_update_foreign_inventory = "UPDATE foreign_inventory SET url = '$url' WHERE user_id = $user_id AND id = $foreign_inventory_id;";
    $result_update_foreign_inventory = mysqli_query($conn, $query_update_foreign_inventory);
    // Let's alert the user and redirect
    if ($result_update_foreign_inventory) {
        ?>
        <script type="text/javascript">
            alert("Inventory updating succeeded.");
            window.location.replace("overview.php");
        </script>
        <?php
        die();
    } else {
        ?>
        <script type="text/javascript">
            alert("Something went wrong while updating the inventory.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
            window.location.replace("overview.php");
        </script>
        <?php
        die();
    }
} else {
    $query_insert_foreign_inventory = "INSERT INTO foreign_inventory (user_id, url) VALUES ($user_id, '$url');";
    $result_insert_foreign_inventory = mysqli_query($conn, $query_insert_foreign_inventory);
    // Let's alert the user and redirect
    if ($result_insert_foreign_inventory) {
        ?>
        <script type="text/javascript">
            alert("Inventory adding succeeded.");
            window.location.replace("overview.php");
        </script>
        <?php
        die();
    } else {
        ?>
        <script type="text/javascript">
            alert("Something went wrong while adding the inventory.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
            window.location.replace("overview.php");
        </script>
        <?php
        die();
    }
}