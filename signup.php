<?php require_once 'header_links.php'; ?>
<?php require_once 'main_header.php'; ?>

    <section class="signup-sec">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3">
                <form id="sign_up" name="sign_up" action="sign_up.php" method="post">
                    <div class="signup-content">
                        <h3>Wedding Dreamer</h3>
                        <h4>Sign up Today</h4>
                        <div class="input-field">
                            <input id="name_sign_up" name="name" type="text" placeholder="Username" required="required">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="input-field">
                            <input id="email_sign_up" name="email" type="email" placeholder="Email" required="required">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="input-field">
                            <input id="password_sign_up" name="password" type="password" placeholder="Password"
                                   required="required">
                            <i class="fa fa-lock"></i>
                        </div>
                        <button>Continue></button>
                        <h5>Or Signup with social media</h5>
                        <div class="social-links">
                            <a href="sign_up_facebook.php"><i class="fa fa-facebook-square"></i></a>
                            <!--<a href="sign_up_google_plus.php"><i class="fa fa-google-plus-square"></i></a>-->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php require_once 'footer_links.php'; ?>