<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/14/18
 * Time: 9:34 AM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id']; // id of the current user
// Let's fetch the id of the foreign inventory to be deleted
$foreign_inventory_id = $_GET['id'];
// Let's delete the foreign inventory if it actually belongs to this user
$query_delete_foreign_inventory = "DELETE FROM foreign_inventory WHERE id = $foreign_inventory_id AND user_id = $user_id";
$result_delete_foreign_inventory = mysqli_query($conn, $query_delete_foreign_inventory);
if ($result_delete_foreign_inventory) {
    ?>
    <script type="text/javascript">
        alert("Inventory deleting succeeded.");
        window.location.replace("view-foreign-inventories.php");
    </script>
    <?php
    die();
} else {
    ?>
    <script type="text/javascript">
        alert("Something went wrong while deleting the inventory.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
        window.location.replace("view-foreign-inventories.php");
    </script>
    <?php
    die();
}