<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/13/18
 * Time: 8:28 PM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id'];
?>
<!-- Links to add either local or foreign inventories -->
<dif id="add_inventories">
    <a href="local-inventory.php">Add local inventory</a><br>
    <a href="foreign-inventory.php">Add foreign inventory</a><br>
</dif>
<br>
<!-- Links to view either local or foreign inventories -->
<dif id="view_inventories">
    <a href="view-local-inventories.php">View local inventories</a><br>
    <a href="view-foreign-inventories.php">View foreign inventories</a>
</dif>