<!--
- Created by IntelliJ IDEA.
- User: Nishen Peiris
- Date: 4/12/18
- Time: 7:07 PM
-->
<!-- CSS for carousel-->
<style>
    * {
        box-sizing: border-box
    }

    body {
        font-family: Verdana, sans-serif;
        margin: 0
    }

    .mySlides {
        display: none
    }

    img {
        vertical-align: middle;
    }

    /* Slideshow container */
    .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
    }

    /* Next & previous buttons */
    .prev, .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -22px;
        /*color: white; when the background is white, arrows are invisible*/
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover, .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Caption text */
    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active, .dot:hover {
        background-color: #717171;
    }

    /* Fading animation */
    .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @-webkit-keyframes fade {
        from {
            opacity: .4
        }
        to {
            opacity: 1
        }
    }

    @keyframes fade {
        from {
            opacity: .4
        }
        to {
            opacity: 1
        }
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
        .prev, .next, .text {
            font-size: 11px
        }
    }
</style>
<?php
include_once "../config/db_connection.php";
// Let's get the required details of the user
$query_fetch_required_user_details = "SELECT name, partner, wedding_date FROM user WHERE id = '$user_id';";
$result_required_user_details = mysqli_query($conn, $query_fetch_required_user_details);
$user_details = mysqli_fetch_assoc($result_required_user_details);
$user_name = $user_details['name'];
$partner = $user_details['partner'];
$wedding_date = $user_details['wedding_date'];
// Let's get the user, whose website is being visited
$user_id = $_GET['user_id'];
// Load photos of the user
$query_photos = "SELECT caption, photo_name FROM wedding_album WHERE user_id = $user_id;";
$result_photos = mysqli_query($conn, $query_photos);
// If the user has no photos, then alert on this and redirect to the home page
if (!$result_photos) {
    ?>
    <script type="text/javascript">
        alert("No photos have been added yet.\nYou can try again or skip for now.");
        window.location.replace("home.php");
    </script>
    <?php
    die();
}
?>
<div id="couple"><?php echo $user_name . " / " . $partner; ?></div>
<div id="wedding_date"><?php echo $wedding_date; ?></div>
<!-- Links to other pages -->
<a href="home.php?user_id=<?php echo $user_id; ?>">Home</a>
<a href="photo-album.php?user_id=<?php echo $user_id; ?>">Photo album</a>
<h1>Welcome</h1>
<!-- Let's display the photos in a carousel -->
<!-- Slideshow container -->
<div class="slideshow-container">
    <?php
    $number = 1;
    $total_number_of_photos = mysqli_num_rows($result_photos);
    while ($photo = mysqli_fetch_assoc($result_photos)) {
        ?>
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
            <div class="numbertext"><?php echo $number . " / " . $total_number_of_photos; ?></div>
            <img src="<?php echo $photo['photo_name']; ?>" style="width: 100%">
            <div class="text"><?php echo $photo['caption']; ?></div>
        </div>
        <?php
        $number = $number + 1;
    }
    ?>
    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>
<!-- The dots/circles -->
<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
</div>

<!-- Scripts for carousel -->
<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
</script>