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
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$color_id = $_POST['color'];
// If the request has a local_inventory_id, then its an update requests
// Else its a insert
if (!empty($_POST['local_inventory_id'])) {
    $local_inventory_id = $_POST['local_inventory_id'];
    $query_update_local_inventory = "UPDATE local_inventory SET name = '$name', description = '$description', price = '$price', color = '$color_id' WHERE user_id = $user_id AND id = $local_inventory_id;";
    $result_update_local_inventory = mysqli_query($conn, $query_update_local_inventory);
    // Let's alert the user and redirect
    if ($result_update_local_inventory) {
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
    $query_insert_local_inventory = "INSERT INTO local_inventory (user_id, name, description, price, color) VALUES ($user_id, '$name', '$description', $price, $color_id);";
    $result_insert_local_inventory = mysqli_query($conn, $query_insert_local_inventory);
    // Let's alert the user and redirect
    if ($result_insert_local_inventory) {
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