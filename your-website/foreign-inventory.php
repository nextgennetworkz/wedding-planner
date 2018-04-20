<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/14/18
 * Time: 11:49 AM
 */
include_once "../config/db_connection.php";
include_once "../header_links.php";
// Let's get the user, whose website is being visited
if (!empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    // Let's fetch the foreign inventories of this user
    $query_load_foreign_inventories = "SELECT url FROM foreign_inventory WHERE user_id = $user_id";
    $result_foreign_inventories = mysqli_query($conn, $query_load_foreign_inventories);
} else {
    ?>
    <script type="text/javascript">
        alert("The request URL is invalid.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
    </script>
    <?php
    die();
}
// Let's get the required details of the user
$query_fetch_required_user_details = "SELECT name, partner, wedding_date FROM user WHERE id = '$user_id';";
$result_required_user_details = mysqli_query($conn, $query_fetch_required_user_details);
if ($result_required_user_details) {
    $user_details = mysqli_fetch_assoc($result_required_user_details);
    $user_name = $user_details['name'];
    $partner = $user_details['partner'];
    $wedding_date = $user_details['wedding_date'];
    ?>
    <section class="myweb-home-sec">
        <div class="container">
            <div class="col-sm-push-1 col-sm-10">
                <div class="myweb-home-container">
                    <?php include_once "website-navigation.php"; ?>
                    <div class="topnav" id="myTopnav">
                        <a href="home.php?user_id=<?php echo $user_id; ?>" >Home</a>
                        <a href="photo-album.php?user_id=<?php echo $user_id; ?>">Photo Album</a>
                        <a href="local-inventory.php?user_id=<?php echo $user_id; ?>" >Local inventory</a>
                        <a href="foreign-inventory.php?user_id=<?php echo $user_id; ?>" class="active">Foreign inventory</a>
                        <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                    </div>
                    <div class="inner-wrp">
                        <table class="">
                            <thead>
                            <tr>URL</tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($foreign_inventory = mysqli_fetch_assoc($result_foreign_inventories)) {
                                ?>
                                <tr>
                                    <td><a href="<?php echo $foreign_inventory['url']; ?>"
                                           target="_blank"><?php echo $foreign_inventory['url']; ?></a></td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- Let's display the list of foreign inventories -->

    <?php
} else {
    ?>
    <script type="text/javascript">
        alert("Something went wrong.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
    </script>
    <?php
    die();
}