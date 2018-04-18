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
<?php require_once 'header_links.php'; ?>
<?php require_once 'main_header.php'; ?>
    <section class="signup-sec">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3">
                <form id="sign_up" name="sign_up" action="sign_up.php" method="post">
                    <div class="signup-content">
                        <form id="verify_email_form" name="verify_email_form" action="verfiy_email_process.php" method="post">
                            <fieldset>
                                <legend><h2>Verify Your Email</h2></legend>

                                <div class="input-field">
                                    <input type="email" id="email" name="email" readonly="readonly" required="required"
                                           value="<?php echo $email; ?>"><br>
                                </div>
                                <div class="input-field">
                                    <input type="text" id="activation_code" placeholder="Verification Code" name="activation_code" required="required"><br>
                                </div>

                                <button>Verify</button>
                            </fieldset>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php require_once 'footer_links.php'; ?>