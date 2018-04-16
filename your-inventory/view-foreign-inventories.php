<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/14/18
 * Time: 8:01 AM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id']; // id of the current user
// Let's load all the foreign inventories of this user
$query_load_foreign_inventories = "SELECT id, url FROM foreign_inventory WHERE user_id = $user_id";
$result_foreign_inventories = mysqli_query($conn, $query_load_foreign_inventories);
?>
<div id="display_foreign_inventories">
    <table>
        <thead>
        <tr>
            <th>URL</th>
            <th>Operation</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($foreign_inventory = mysqli_fetch_assoc($result_foreign_inventories)) {
            ?>
            <tr>
                <td><?php echo $foreign_inventory['url']; ?></td>
                <td>
                    <a href="foreign-inventory.php?id=<?php echo $foreign_inventory['id']; ?>">Edit</a>
                    <a href="delete-foreign-inventory.php?id=<?php echo $foreign_inventory['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
