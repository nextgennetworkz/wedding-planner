<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/12/18
 * Time: 7:06 PM
 */
include_once "../config/db_connection.php";
include_once "../header_links.php";
// Let's get the user, whose website is being visited
if (!empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
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
    $wedding_date = explode(" ", $wedding_date)[0];
    ?>
    <!-- Let's create the home page -->

    <section class="myweb-home-sec">
        <div class="container">
            <div class="col-sm-push-1 col-sm-10">
                <div class="myweb-home-container">
                    <?php include_once "website-navigation.php"; ?>
                    <div class="topnav" id="myTopnav">
                        <a href="home.php?user_id=<?php echo $user_id; ?>" class="active">Home</a>
                        <a href="photo-album.php?user_id=<?php echo $user_id; ?>">Photo Album</a>
                        <a href="local-inventory.php?user_id=<?php echo $user_id; ?>">Local inventory</a>
                        <a href="foreign-inventory.php?user_id=<?php echo $user_id; ?>">Foreign inventory</a>
                        <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                    </div>
                    <div class="inner-wrp">
                        <h2>WELCOME</h2>
                        <img src="../img/couple2.jpg" class="img-responsive">
                        <p>
                            Dear Family and Friends, Please fasten your seatbelts, and get ready for our next destination: OUR WEDDING
                            CELEBRATION! We are delighted to share this special adventure with those of you who will be joining us at our
                            celebration and of course those who will be present in our hearts! On this website you will find all the details
                            about our party. If you need any help, please let us know! We will be posting information regularly so stay
                            tuned. Looking forward to seeing you all soon! Love,
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <?php
} else {
    ?>
    <script type="text/javascript">
        alert("Something went wrong.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
    </script>
    <?php
    die();
}