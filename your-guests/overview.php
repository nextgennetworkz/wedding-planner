<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/29/18
 * Time: 12:35 PM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: index.php');
}
$user_id = $_SESSION['user_id'];

// Retrieve all guests of currently logged in user
$result_guests = mysqli_query($conn, "SELECT * FROM guest WHERE user_id = $user_id");

$no_of_notified_guests = $no_of_attending_guests = $no_of_not_attending_guests = $no_of_not_answered_guests = $no_of_total_guests = 0;
?>

    <p>Total guests <?php echo $no_of_total_guests; ?></p>
    <a href="add-new-guest.php">Add a guest</a>

    <p><?php echo $no_of_notified_guests; ?> guests notified: <a href="">Send Save the Date</a></p>
    <p><?php echo $no_of_attending_guests; ?> attending | <?php echo $no_of_not_attending_guests; ?> not attending
        | <?php echo $no_of_not_answered_guests; ?> not answered. <a href="">Send RSVP email</a></p>

    <!-- Guest list -->
<?php
if ($result_guests) {
    ?>
    <table>
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