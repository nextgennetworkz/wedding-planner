<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/1/18
 * Time: 12:19 PM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
include_once "../header_links.php";
include_once "../main_header.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}

// user's id
$userId = $_SESSION['id'];

// fetch username and partner's name
$username = $_SESSION['name'];
//$partner =

// Fetch list of guest to whom invitations are not sent
$query = "SELECT first_name, last_name, email FROM guest WHERE user_id = $userId";
$result_guests = mysqli_query($conn, $query);

// Set mail subject
$subject = "Thank you";
// Set mail body
$body = "We want to take a moment to express our appreciation for your presence on our wedding day.\n\n";
$body = $body . $username . " and " . $partner;
?>

<form action="/wedding-planner/mail/send-mail.php" method="post">
    <h1>SEND E-THANK YOU CARD</h1>
    <fieldset>
        <legend>Guest management</legend>
        <!-- Should be hidden at page load -->
        <div id="guest-management">
            <select id="selected_guests" name="selected_guests[]" multiple="multiple">
                <?php
                while ($guest = mysqli_fetch_array($result_guests)) {
                    ?>
                    <option value="<?php echo $guest['email']; ?>"><?php echo $guest['first_name'] . " " . $guest['last_name']; ?></option>
                    <?php
                }
                ?>
            </select>
            <p>Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</p>
        </div>
    </fieldset>
    <fieldset>
        <legend>Say thank you to your guests</legend>
        <!-- When clicked guest-management div should be shown -->
        <a href="">Add more guests</a><br>
        Subject * <input type="text" id="subject" name="subject" required="required"
                         value="<?php echo $subject; ?>"><br>
        Message * <textarea id="message" name="message" required="required" rows="8"
                            cols="100"><?php echo $body; ?></textarea>
    </fieldset>
    <button>Send</button>
</form>