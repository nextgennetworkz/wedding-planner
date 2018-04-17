<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/14/18
 * Time: 8:01 AM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
include_once "../header_links.php";
include_once "../main_header.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id']; // id of the current user
// Let's load all the local inventories of this user
$query_load_local_inventories = "SELECT LI.id, name, description, price, C.color FROM local_inventory LI INNER JOIN color C ON LI.color = C.id WHERE LI.user_id = $user_id;";
$result_local_inventories = mysqli_query($conn, $query_load_local_inventories);
?>
<section class="view-inventory-sec">
    <div class="container">
        <div id="display_local_inventories">
            <table class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Color</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($local_inventory = mysqli_fetch_assoc($result_local_inventories)) {
                    ?>
                    <tr>
                        <td><?php echo $local_inventory['name']; ?></td>
                        <td><?php echo $local_inventory['description']; ?></td>
                        <td><?php echo $local_inventory['price']; ?></td>
                        <td><?php echo $local_inventory['color']; ?></td>
                        <td>
                            <a href="local-inventory.php?id=<?php echo $local_inventory['id']; ?>">Edit</a>
                            <a href="delete-local-inventory.php?id=<?php echo $local_inventory['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
