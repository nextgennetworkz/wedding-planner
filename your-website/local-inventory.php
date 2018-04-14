<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/14/18
 * Time: 11:49 AM
 */
include_once "../config/db_connection.php";
// Let's get the user, whose website is being visited
if (!empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    // Let's fetch the local inventories of this user
    $query_load_local_inventories = "SELECT LI.name, LI.description, LI.price, C.color FROM local_inventory LI INNER JOIN color C ON LI.color = C.id WHERE LI.user_id = $user_id";
} else if (!empty($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    // Let's fetch the local inventories of this user
    $query_load_local_inventories = "SELECT LI.name, LI.description, LI.price, C.color FROM local_inventory LI INNER JOIN color C ON LI.color = C.id WHERE LI.user_id = $user_id";
    // If color is provided, then add the color filter to the query
    if (!empty($_POST['color'])) {
        $color = $_POST['color'];
        $query_load_local_inventories = $query_load_local_inventories . " AND LI.color = $color";
    }
    // If the price range is provided, let's add price filter as well
    if (!empty($_POST['price'])) {
        $price = $_POST['price'];
        $query_load_local_inventories = $query_load_local_inventories . " AND LI.price < $price";
    }
} else {
    ?>
    <script type="text/javascript">
        alert("The request URL is invalid.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
    </script>
    <?php
    die();
}
// Let's load the list of colors available from the database
$query_load_colors = "SELECT id, color FROM color;";
$result_colors = mysqli_query($conn, $query_load_colors);
$result_local_inventories = mysqli_query($conn, $query_load_local_inventories);
// Let's get the required details of the user
$query_fetch_required_user_details = "SELECT name, partner, wedding_date FROM user WHERE id = '$user_id';";
$result_required_user_details = mysqli_query($conn, $query_fetch_required_user_details);
if ($result_required_user_details) {
    $user_details = mysqli_fetch_assoc($result_required_user_details);
    $user_name = $user_details['name'];
    $partner = $user_details['partner'];
    $wedding_date = $user_details['wedding_date'];
    ?>
    <!-- Let's create the home page -->
    <?php include_once "website-navigation.php"; ?>
    <!-- Form to apply filters -->
    <form id="filter_local_inventories_form" name="filter_local_inventories_form"
          action="local-inventory.php" method="post">
        <fieldset>
            <legend>Filter local inventories</legend>
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
            Color:
            <select id="color" name="color">
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
            Price (less than):
            <input type="number" step="0.01" id="price" name="price"><br>
            <input type="submit" value="Save">
        </fieldset>
    </form>
    <!-- Let's display the list of local inventories -->
    <table>
        <thead>
        <tr>Name</tr>
        <tr>Description</tr>
        <tr>Price</tr>
        <tr>Color</tr>
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
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
} else {
    ?>
    <script type="text/javascript">
        alert("Something went wrong.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
    </script>
    <?php
    die();
}