<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/29/18
 * Time: 12:36 PM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
include_once "../header_links.php";
include_once "../main_header.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
?>
<section class="add-guest-sec">
    <div class="container add-guest-wrp">
        <button class="back-btn"><a href="overview.php">< Back</a></button>
        <form action="add-new-guest-process.php" method="post">
            <h1>NEW GUEST</h1>
            <div class="row">
                <div class="col-sm-6 left-content">
                    <fieldset>
                        <legend>Add a new contact to your guest list</legend>
                        <div class="input-wrp">
                            <span>First name *</span><br>
                            <input type="text" id="first_name" name="first_name" required="required"><br>
                        </div>
                        <div class="input-wrp">
                            <span>Last name </span><br>
                            <input type="text" id="last_name" name="last_name"><br>
                        </div>
                        <div class="input-wrp">
                            <span>Email *</span><br>
                            <input type="email" id="email" name="email" required="required"><br>
                        </div>
                        <div class="input-wrp">
                            <span>Address</span><br>
                            <input type="text" id="address" name="address"><br>
                        </div>
                        <div class="input-wrp">
                            <span>Mobile</span><br>
                            <input type="tel" id="mobile_number" name="mobile_number"><br>
                        </div>
                    </fieldset>
                </div>
                <div class="col-sm-6">
                    <fieldset>
                        <legend>Attendance</legend>
                        <div class="input-wrp">
                            <input type="radio" name="attendance" value="not_notified" checked="checked"> Not
                            notified<br>
                        </div>
                        <div class="input-wrp">
                            <input type="radio" name="attendance" value="not_attending"> Not attending<br>
                        </div>
                        <div class="input-wrp">
                            <input type="radio" name="attendance" value="attending"> Attending<br>
                        </div>
                        <button class="add-btn">Add</button>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
</section>
