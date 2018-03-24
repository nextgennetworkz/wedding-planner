<?php include_once "config/validate_session.php"; ?>

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
                    <a class="navbar-brand" href="#">Wedding Dreamer</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Need to check if the user is logged in or not. If the user is logged in, we sholdn't be showing the sign up and sign in links -->
                        <?php
                        if ($is_user_logged_in == "TRUE") {
                            ?>
                            <p style="color: white"><?php echo $_SESSION['name']; ?></p>
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
                    <h3>Wedding Dreamer</h3>
                    <h4>Login to your account</h4>
                    <div class="input-field">
                        <input type="email" placeholder="Email"><i class="fa fa-envelope"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" placeholder="Password"><i class="fa fa-lock"></i>
                    </div>
                    <button>Login</button>
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