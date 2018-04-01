<?php
// Allow only logged in users
include_once "../config/validate_session.php";
include_once "../header_links.php";
include_once "../main_header.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: index.php');
}
$user_id = $_SESSION['user_id'];

// Retrieve all guests of currently logged in user
$result_guests = mysqli_query($conn, "SELECT * FROM guest WHERE user_id = $user_id");

$no_of_notified_guests = $no_of_attending_guests = $no_of_not_attending_guests = $no_of_not_answered_guests = $no_of_total_guests = 0;
?>
<section class="overview-sec" xmlns="http://www.w3.org/1999/html">
    <div class="container overview-cont">
        <div class="row">
            <div class="col-sm-3">
                <div class="count-wrp">
                    <p>Total guests</p>
                    <span><?php echo $no_of_total_guests; ?></span><br>
                    <button><a href="add-new-guest.php"><i class="fa fa-plus"></i> Add a Guest</a></button>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="right-side">
                    <h2><?php echo $_SESSION['name']; ?>, Let's add your guests to guest list.</h2>
                    <p><i class="fa fa-calendar"></i> <?php echo $no_of_notified_guests; ?> guests notified: <a href="">Send Save the Date</a></p>
                    <p><i class="fa fa-users"></i> <?php echo $no_of_attending_guests; ?> attending | <?php echo $no_of_not_attending_guests; ?> not attending
                        | <?php echo $no_of_not_answered_guests; ?> not answered. <a href="">Send RSVP email</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Guest list -->
    <?php
    if ($result_guests) {
        ?>
        <table class="table">
            <thead>
            <th>First name</th>
            <th>Last name</th>
            <th>email</th>
            <th>Address</th>
            <th>Mobile number</th>
            </thead>
            <tbody>
            <?php
            while ($guest = mysqli_fetch_array($result_guests)) {
                ?>
                <tr><?php echo $guest['first_name']; ?></tr>
                <tr><?php echo $guest['last_name']; ?></tr>
                <tr><?php echo $guest['email']; ?></tr>
                <tr><?php echo $guest['address']; ?></tr>
                <tr><?php echo $guest['mobile_number']; ?></tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    <?php
    }
    ?>
</section>

