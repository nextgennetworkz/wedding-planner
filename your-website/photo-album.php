<!--
- Created by IntelliJ IDEA.
- User: Nishen Peiris
- Date: 4/12/18
- Time: 7:07 PM
-->
<?php
include_once "../config/db_connection.php";
include_once "../header_links.php";
// Let's get the user, whose website is being visited
$user_id = $_GET['user_id'];
// Let's get the required details of the user
$query_fetch_required_user_details = "SELECT name, partner, wedding_date FROM user WHERE id = '$user_id';";
$result_required_user_details = mysqli_query($conn, $query_fetch_required_user_details);
$user_details = mysqli_fetch_assoc($result_required_user_details);
$user_name = $user_details['name'];
$partner = $user_details['partner'];
$wedding_date = $user_details['wedding_date'];
$wedding_date = explode(" ", $wedding_date)[0];
// Load photos of the user
$query_photos = "SELECT caption, photo_name FROM wedding_album WHERE user_id = $user_id;";
$result_photos = mysqli_query($conn, $query_photos);
// If the user has no photos, then alert on this and redirect to the home page
if (!$result_photos) {
    ?>
    <script type="text/javascript">
        alert("No photos have been added yet.\nYou can try again or skip for now.");
        window.location.replace("home.php");
    </script>
    <?php
    die();
}
?>

<section class="myweb-home-sec">
    <div class="container">
        <div class="col-sm-push-1 col-sm-10">
            <div class="myweb-home-container">
                <?php include_once "website-navigation.php"; ?>
                <div class="topnav" id="myTopnav">
                    <a href="home.php?user_id=<?php echo $user_id; ?>">Home</a>
                    <a href="photo-album.php?user_id=<?php echo $user_id; ?>" class="active">Photo Album</a>
                    <a href="local-inventory.php?user_id=<?php echo $user_id; ?>">Local inventory</a>
                    <a href="foreign-inventory.php?user_id=<?php echo $user_id; ?> ">Foreign inventory</a>
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon"
                       onclick="myFunction()">&#9776;</a>
                </div>
                <div class="inner-wrp">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="../img/couple2.jpg" alt="Los Angeles" style="width:100%;">
                            </div>
                            <div class="item">
                                <img src="../img/2-1600.jpg" alt="Chicago" style="width:100%;">
                            </div>
                            <div class="item">
                                <img src="../img/13-1600.jpg" alt="New york" style="width:100%;">
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>