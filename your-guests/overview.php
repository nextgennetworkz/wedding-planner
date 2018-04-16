<?php
// Allow only logged in users
include_once "../config/validate_session.php";
include_once "../header_links.php";
include_once "../main_header.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: index.php');
}
$user_id = $_SESSION['id'];

$no_of_attending_guests = $no_of_not_attending_guests = $no_of_not_notified_guests = $no_of_total_guests = 0;

// no of attending guests
$result_attending_guests = mysqli_query($conn, "SELECT COUNT(id) AS count FROM guest WHERE attendance = 'attending' AND user_id = $user_id");
$result_attending_guests = mysqli_fetch_assoc($result_attending_guests);
$no_of_attending_guests = $result_attending_guests['count'];


// no. of not attending guests
$result_not_attending_guests = mysqli_query($conn, "SELECT COUNT(id) AS count FROM guest WHERE attendance = 'not_attending' AND user_id = $user_id");
$result_not_attending_guests = mysqli_fetch_assoc($result_not_attending_guests);
$no_of_not_attending_guests = $result_not_attending_guests['count'];

// no. of not notified guests
$result_not_notified_guests = mysqli_query($conn, "SELECT COUNT(id) AS count FROM guest WHERE attendance = 'not_notified' AND user_id = $user_id");
$result_not_notified_guests = mysqli_fetch_assoc($result_not_notified_guests);
$no_of_not_notified_guests = $result_not_notified_guests['count'];

// no. of total guests in guest book
$no_of_total_guests = $no_of_attending_guests + $no_of_not_attending_guests + $no_of_not_notified_guests;

// all the guest of this user
$result_all_guests = mysqli_query($conn, "SELECT first_name, last_name, email, address, mobile_number, attendance FROM guest WHERE user_id = $user_id ORDER BY attendance");
?>
<section class="overview-sec" xmlns="http://www.w3.org/1999/html">
    <div class="container overview-cont">
        <div class="row">
            <div class="col-sm-3">
                <div class="count-wrp">
                    <p>Total guests</p>
                    <span class="number"><?php echo $no_of_total_guests; ?></span><br>
                    <button class="add-btn"><a href="add-new-guest.php"><i class="fa fa-plus"></i> Add a Guest</a></button>
                    or
                    <!-- import guests from Excel sheet -->
                    <form action="import-guests-from-excel.php" method="post" enctype="multipart/form-data">
                        <p>Upload an Excel sheet of guests:</p>
<!--                        <input type="file" id="file_to_upload" name="file_to_upload" accept=".xlsx" >-->
                        <button id="fileupload-example-5" id="file_to_upload" name="file_to_upload" accept=".xlsx">
                            <input type="file">
                            <span>Select a File</span>
                        </button><br>
                        <input type="submit" value="Upload" name="submit" class="upload-file">
                    </form>

                </div>
            </div>
            <div class="col-sm-9">
                <div class="right-side">
                    <h2><?php echo $_SESSION['name']; ?>, Let's add your guests to guest list.</h2>
                    <p><i class="fa fa-users"></i> <?php echo $no_of_attending_guests; ?> attending
                        | <?php echo $no_of_not_attending_guests; ?> not attending
                        | <?php echo $no_of_not_notified_guests; ?> not notified.<br>
                        <i class="fa fa-envelope"></i> <a href="/wedding-planner/your-guests/send-e-wedding-card.php"> Send e-wedding card</a>
                        | <a href="/wedding-planner/your-guests/send-e-thank-you-card.php">Send e-thank you card</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Guest list -->
    <?php
    if ($no_of_total_guests > 0) {
        ?>
        <table class="table">
            <thead>
            <th>First name</th>
            <th>Last name</th>
            <th>email</th>
            <th>Address</th>
            <th>Mobile number</th>
            <th>Attendance</th>
            <th>Operation</th>
            </thead>
            <tbody>
            <?php
            while ($guest = mysqli_fetch_array($result_all_guests)) {
                ?>
                <tr>
                    <td><?php echo $guest['first_name']; ?></td>
                    <td><?php echo $guest['last_name']; ?></td>
                    <td><?php echo $guest['email']; ?></td>
                    <td><?php echo $guest['address']; ?></td>
                    <td><?php echo $guest['mobile_number']; ?></td>
                    <td>
                        <?php
                        if ($guest['attendance'] == 'attending') {
                            echo "Attending";
                        } else if ($guest['attendance'] == 'not_attending') {
                            echo "Not attending";
                        } else {
                            echo "Not notified";
                        }
                        ?>
                    </td>
                    <td>action</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }
    ?>
</section>

