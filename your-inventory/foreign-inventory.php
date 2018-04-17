<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/14/18
 * Time: 7:59 AM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
include_once "../header_links.php";
include_once "../main_header.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id']; // id of the current user
// If the request is to update an inventory, we should receive the id as a url param
if (isset($_GET['id'])) {
    $foreign_inventory_id = $_GET['id'];
    // Let's load the foreign inventory from the database
    $query_load_foreign_inventory = "SELECT user_id, url FROM foreign_inventory WHERE user_id = $user_id AND id = $foreign_inventory_id";
    $result_load_foreign_inventory = mysqli_query($conn, $query_load_foreign_inventory);
    if ($result_load_foreign_inventory) {
        $foreign_inventory = mysqli_fetch_assoc($result_load_foreign_inventory);
        $url = $foreign_inventory['url'];
    } else {
        ?>
        <script type="text/javascript">
            alert("Something went wrong.\nYou can try again or skip for now.");
            window.location.replace("overview.php");
        </script>
        <?php
        die();
    }

} else {
    $foreign_inventory_id = $url = "";
}
?>
<section class="inventory-sec">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <form id="add_or_edit_foreign_inventory_form" name="add_or_edit_foreign_inventory_form"
                      action="foreign-inventory-process.php" method="post">
                    <h1>INVENTORY MANAGEMENT</h1>
                    <fieldset>
                        <legend>Add URLs of foreign inventory</legend>
                        <input type="hidden" id="foreign_inventory_id" name="foreign_inventory_id"
                               value="<?php echo $foreign_inventory_id; ?>">
                        <span>URL</span>
                        <input type="text" id="url" name="url" required="required" value="<?php echo $url; ?>"><br>
                        <button>Save</button>
                    </fieldset>
                </form>
            </div>
            <div class="col-sm-4">
                <div class="inventory-wrp">
                    <a href="view-foreign-inventories.php"><span class="glyphicon glyphicon-briefcase"></span> View My<br> Foreign Inventory</a>
                </div>
            </div>
        </div>
    </div>

</section>

