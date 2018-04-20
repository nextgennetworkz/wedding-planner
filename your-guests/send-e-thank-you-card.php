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
$userId = $_SESSION['id']; // user's id
// fetch username and partner's name
$username = $_SESSION['name'];
// Get partner's name
$query_fetch_partner_name = "SELECT partner FROM user WHERE id = $userId";
$result_partner_name = mysqli_query($conn, $query_fetch_partner_name);
$partner = mysqli_fetch_assoc($result_partner_name)['partner'];
// Fetch list of guest to whom invitations are not sent
$query = "SELECT first_name, last_name, email FROM guest WHERE user_id = $userId";
$result_guests = mysqli_query($conn, $query);
$subject = "Thank you"; // Set mail subject
$body = "We want to take a moment to express our appreciation for your presence on our wedding day.\n\n"; // Set mail body
$body = $body . $username . " and " . $partner; // append names to body
?>
<section class="wedding-card-sec">
    <div class="container">
        <div class="form-wrp">
            <form action="/wedding-planner/mail/send-mail.php" method="post">
                <h1>SEND E-THANK YOU CARD</h1>
                <fieldset>
                    <legend>Guest management</legend>
                    <!-- Should be hidden at page load -->
                    <div id="guest-management">
                        <select id="selected_guests" name="selected_guests[]" multiple="multiple" style="width: 100%">
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
                    <span>Subject *</span><br>
                    <input type="text" id="subject" name="subject" required="required"
                           value="<?php echo $subject; ?>"><br>
                    <span>Message *</span><br>
                    <textarea id="message" name="message" required="required" rows="8"
                              cols="100"><?php echo $body; ?></textarea>
                </fieldset>
                <button>Send</button>
            </form>
        </div>
    </div>
</section>
