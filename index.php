<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Wedding Dreamer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content=""/>
    <!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bootstrap-theme.min.css" rel="stylesheet"/>
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/animate.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="css/animate.css"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <link href="css/responsive.css" rel="stylesheet"/>
    <!----js---->
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<?php
require_once 'main_header.php';
?>

<section class="main-caro-sec">
    <div id="carousel slide" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="caro-text">
                <h1>Join With us to plan your Dream day...</h1>
            </div>
            <div class="item active">
                <img src="img/wedding-reportage-1920x1000.jpg" class="img-responsive" alt="Chania"
                     style="width:100%; height:95vh">
            </div>

            <div class="item">
                <img src="img/hochzeitsfotograf-berlin-villa-kogge-sonne-1920x1000.jpg" class="img-responsive"
                     alt="Chania" style="width:100%; height:95vh">
            </div>
            <div class="item">
                <img src="img/wedding-couple-1920x1080.jpg" class="img-responsive" alt="Flower"
                     style="width:100%; height:95vh">
            </div>

            <div class="item">
                <img src="img/wedding_newlyweds_couple_romance_love_113876_1920x1080.jpg" class="img-responsive"
                     alt="Flower" style="width:100%; height:95vh">
            </div>

            <div class="item">
                <img src="img/Untitled-1-1920x1000.jpg" class="img-responsive" alt="Flower"
                     style="width:100%; height:95vh">
            </div>
            <div class="item">
                <img src="img/rings_couple_wedding_silver_flowers_80327_1920x1080.jpg" class="img-responsive"
                     alt="Flower" style="width:100%; height:95vh">
            </div>
            <div class="item">
                <img src="img/wedding_hands_heart_love_romance_116630_1920x1080.jpg" class="img-responsive"
                     alt="Flower" style="width:100%; height:95vh">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<footer>
    <script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery.min.js" type="text/javascript"></script>
    <script src="../js/tutorial.js"></script>
    <script src="../js/wow.min.js"></script>
    <script src="../js/script.js" type="text/javascript"></script>
</footer>
</body>
</html>