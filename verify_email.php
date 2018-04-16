<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/14/18
 * Time: 6:18 PM
 */
// Let's get the email to be verified
$email = $_GET['email'];
?>
<form id="verify_email_form" name="verify_email_form" action="verfiy_email_process.php" method="post">
    <fieldset>
        <legend>Verify your email</legend>
        Email:
        <input type="email" id="email" name="email" readonly="readonly" required="required"
               value="<?php echo $email; ?>"><br>
        Verification code:
        <input type="text" id="activation_code" name="activation_code" required="required"><br>
        <input type="submit" value="Verify">
    </fieldset>
</form>
