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
// Let's load the list of colors available from the database
$query_load_colors = "SELECT id, color FROM color;";
$result_colors = mysqli_query($conn, $query_load_colors);
// If the request is to update an inventory, we should receive the id as a url param
if (isset($_GET['id'])) {
    $local_inventory_id = $_GET['id'];
    // Let's load the local inventory from the database
    $query_load_local_inventory = "SELECT LI.id, name, description, price, C.id AS color_id, C.color FROM local_inventory LI INNER JOIN color C ON LI.color = C.id WHERE LI.user_id = $user_id AND LI.id = $local_inventory_id";
    $result_load_local_inventory = mysqli_query($conn, $query_load_local_inventory);
    if ($result_load_local_inventory) {
        $local_inventory = mysqli_fetch_assoc($result_load_local_inventory);
        $name = $local_inventory['name'];
        $description = $local_inventory['description'];
        $price = $local_inventory['price'];
        $selected_color_id = $local_inventory['color_id'];
        $selected_color = $local_inventory['color'];
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
    $local_inventory_id = $name = $description = $price = $color = $selected_color_id = "";
}
?>
<section class="inventory-sec">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div>
                    <form id="add_or_edit_local_inventory_form" name="add_or_edit_local_inventory_form"
                          action="local-inventory-process.php" method="post">
                        <h1>INVENTORY MANAGEMENT</h1>
                        <fieldset>
                            <legend>Add a local inventory</legend>
                            <input type="hidden" id="local_inventory_id" name="local_inventory_id"
                                   value="<?php echo $local_inventory_id; ?>">
                            <span>Name:</span><br>
                            <input type="text" id="name" name="name" required="required" value="<?php echo $name; ?>"><br>
                            <span>Description:</span><br>
                            <input type="text" id="description" name="description" value="<?php echo $description; ?>"><br>
                            <span>Price:</span><br>
                            <input type="text" id="price" name="price" required="required" value="<?php echo $price; ?>"><br>
                            <span>Color:</span><br>
                            <select id="color" name="color" required="required">
                                <option value="" selected="selected" disabled="disabled">Select color</option>
                                <?php
                                while ($color = mysqli_fetch_assoc($result_colors)) {
                                    ?>
                                    <option value="<?php echo $color['id']; ?>" <?php echo($selected_color_id == $color['id'] ? 'selected="selected"' : '') ?>><?php echo $color['color']; ?></option>
                                <?php
                                }
                                ?>
                                ?>
                            </select><br>
                            <button>Save</button>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="inventory-wrp">
                    <a href="view-local-inventories.php"><span class="glyphicon glyphicon-briefcase"></span> View My<br> Local Inventory</a>
                </div>
            </div>
        </div>
    </div>
</section>
