<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/30/18
 * Time: 11:39 AM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
include_once "../header_links.php";
include_once "../main_header.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
?>
<section class="profile-edit-sec">
    <button class="back-btn"><a href="../index.php">< Back</a></button>
    <div class="container form-sec">
        <form action="edit-profile-process.php" method="post">
            <h1>Profile Data</h1>
            <div class="col-sm-6">
                <fieldset>
                    <legend>Wedding details:</legend>
                    <div class="input-wrp">
                        <span>Your partner</span><br>
                        <input type="text" id="partner" name="partner" placeholder="Your partner's name">
                    </div>
                    <div class="input-wrp">
                        <span>Wedding date</span><br>
                        <input type="date" id="wedding_date" name="wedding_date">
                    </div>
                    <div class="input-wrp">
                        <span>Where are you getting married?</span><br>
                        <input type="text" id="city" name="city" placeholder="City">
                    </div>
                    <div class="input-wrp">
                        <input type="text" id="location_name" name="location_name" placeholder="Location name">
                    </div>
                </fieldset>
            </div>
            <div class="col-sm-6">
                <fieldset>
                    <legend>Basic account info:</legend>
                    <div class="input-wrp">
                        <span>Your name</span><br>
                        <select id="name_prefix" name="name_prefix">
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                        </select>
                    </div>
                    <div class="input-wrp">
                        <span>Phone number</span><br>
                        <input type="tel" id="phone_number" name="phone_number" placeholder="Phone number"><br>
                    </div>
                    <div class="input-wrp">
                        <span>Email</span><br>
                        <input type="email" id="email" name="email" readonly="readonly"><br>
                    </div>
                    <div class="input-wrp">
                        <span>Mailing address</span><br>
                        <input type="text" id="address" name="address" placeholder="Mailing address">
                    </div>
                </fieldset>
                <button class="add-btn">Submit</button>
            </div>
        </form>
    </div>

</section>
