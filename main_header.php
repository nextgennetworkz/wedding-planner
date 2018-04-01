<?php
include_once "config/validate_session.php";
?>
    <!-- Header -->
    <section>
        <nav class="navbar navbar-inverse main-header">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Wedding Dreamer</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <!-- Need to check if the user is logged in or not. If the user is logged in, we sholdn't be showing the below links -->
                        <?php
                        if ($is_user_logged_in == "TRUE") {
                            ?>
                            <li><a href="your-guests/overview.php"><span class="glyphicon glyphicon-user"></span> Guests</a>
                            </li>
                            <li><a href="#"> Page 2</a></li>

                            <?php
                        }
                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Need to check if the user is logged in or not. If the user is logged in, we sholdn't be showing the sign up and sign in links -->
                        <?php
                        if ($is_user_logged_in == "TRUE") {
                            ?>
                            <li class="dropdown"><a href="signup.php"><span
                                            class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['name']; ?>
                                </a>
                                <ul class="dropdown-content">
                                    <li><a href="me/edit-profile.php">Edit Profile</a></li>
                                    <li><a href="logout_process.php">Log out</a></li>
                                </ul>
                            </li>


                            <?php
                        } else {
                            ?>
                            <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                            <li onclick="openNav()"><a href="#"><span class="glyphicon glyphicon-log-in"></span>
                                    Login</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <!--  -->
    <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="login-content">
                    <form id="login_form" name="login_form" action="login_process.php" method="post">
                        <h3>Wedding Dreamer</h3>
                        <h4>Login to your account</h4>
                        <div class="input-field">
                            <input id="login_email" name="email" type="email" placeholder="Email" required="required">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="input-field">
                            <input id="login_password" name="password" type="password" placeholder="Password"
                                   required="required">
                            <i class="fa fa-lock"></i>
                        </div>
                        <button>Login</button>
                    </form>
                    <h5>Or Login With Social Media</h5>
                    <div class="social-links">
                        <a><i class="fa fa-facebook-square"></i></a>
                        <a><i class="fa fa-google-plus-square"></i></a>
                    </div>
                    <span>Don't you have an account? <a>Sign up today</a></span>
                </div>
            </div>
        </div>
    </div>

<?php require_once 'footer_links.php'; ?>