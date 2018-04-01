<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/30/18
 * Time: 11:39 AM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
?>

<form action="edit-profile-process.php" method="post">
    <h1>Profile data</h1>
    <fieldset>
        <legend>Wedding details:</legend>
        Your partner: <input type="text" id="partner" name="partner" placeholder="Your partner's name"><br>
        Wedding date: <input type="date" id="wedding_date" name="wedding_date"><br>
        Where are you getting married?: <input type="text" id="city" name="city" placeholder="City">
        <input type="text" id="location_name" name="location_name" placeholder="Location name"><br>
    </fieldset>
    <fieldset>
        <legend>Basic account info:</legend>
        Your name:
        <select id="name_prefix" name="name_prefix">
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
        </select>
        Phone number: <input type="tel" id="phone_number" name="phone_number" placeholder="Phone number"><br>
        Email: <input type="email" id="email" name="email" readonly="readonly"><br>
        Mailing address: <input type="text" id="address" name="address" placeholder="Mailing address">
    </fieldset>
    <input type="submit" value="Save">
</form>