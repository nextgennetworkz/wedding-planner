<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/12/18
 * Time: 10:31 AM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
include_once "../header_links.php";
include_once "../main_header.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id']; // current users's id
// Let's load photos of this user
$query = "SELECT id, caption, photo_name FROM wedding_album WHERE user_id = '$user_id';";
$result_photos = mysqli_query($conn, $query);
?>
<section class="wedding-album-sec">
    <button class="back-btn"><a href="../index.php">< Back</a></button>
    <div class="container form-sec">
        <!-- This div contains all components related to photo upload -->
        <div id="upload_photos">
            <form id="upload_photos_form" action="upload-image.php" method="post" enctype='multipart/form-data'>
                <h1>WEDDING ALBUM</h1>
                <fieldset>
                    <legend>Upload photos to your wedding album</legend>
                    <img id="preview_image" width="100vw"/><br>
                    <span>Select photo to upload</span><br>
                    <input type="file" id="file_to_upload" name="file_to_upload"
                           accept="image/jpeg, image/pjpeg, image/bmp, image/gif, image/jpg, image/png" required="required"
                           onchange="preview(this);"><br>
                    <span>Caption</span><br>
                    <input type="text" id="caption" name="caption" required="required"><br>
<!--                    <input type="submit" value="Add to album" name="submit" class="submit_btn">-->
                    <button type="submit" name="submit">Add to Album</button>
                </fieldset>
            </form>
            <!-- This div contains all components related to photo display -->
            <div id="display_photos">
                <div class="demo-gallery">
                    <h2>MY WEDDING ALBUM</h2>
                    <ul id="lightgallery" class="list-unstyled row">
                        <?php
                        while ($photo = mysqli_fetch_assoc($result_photos)) {
                            ?>

                            <li class="col-xs-6 col-sm-4 col-md-3" data-src="<?php echo $photo['photo_name']; ?>" data-sub-html="<h4><?php echo $photo['caption']; ?></h4><p><a href='delete-photo.php?id=<?php echo $photo['id']; ?>'> Delete</a></p>">
                                <a href="">
                                    <img class="img-responsive" src="<?php echo $photo['photo_name']; ?>">
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>





<!-- Script to preview when the image is selected -->
<script type="text/javascript">
    function preview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("preview_image").setAttribute("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#lightgallery').lightGallery();
        });
    </script>
<?php
include_once "../footer_links.php";
?>