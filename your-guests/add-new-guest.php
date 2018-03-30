<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/29/18
 * Time: 12:36 PM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
?>

<form action="welcome.php" method="post">
    <h1>New guest</h1>
    <fieldset>
        <legend>Add a new contact to your guest list:</legend>
        First name *: <input type="text" id="first_name" name="first_name" required="required"><br>
        Last name: <input type="text" id="last_name" name="last_name"><br>
        Email: <input type="email" id="email" name="email" required="required"><br>
        Address: <input type="text" id="address" name="address"><br>
        Mobile: <input type="tel" id="mobile_number" name="mobile_number"><br>
    </fieldset>
    <fieldset>
        <legend>Attendance</legend>
        <input type="radio" name="attendance" value="no_response"> No response<br>
        <input type="radio" name="attendance" value="not_attending"> Not attending<br>
        <input type="radio" name="attendance" value="attending"> Attending<br>
    </fieldset>
    <input type="submit">
</form>