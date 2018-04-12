<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/12/18
 * Time: 10:31 AM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id']; // current users's id
// Let's load photos of this user
$query = "SELECT id, caption, photo_name FROM wedding_album WHERE user_id = '$user_id';";
$result_photos = mysqli_query($conn, $query);
?>
<!-- This div contains all components related to photo upload -->
<div id="upload_photos">
    <form id="upload_photos_form" action="upload-image.php" method="post" enctype='multipart/form-data'>
        <h1>Wedding album</h1>
        <fieldset>
            <legend>Upload photos to your wedding album</legend>
            <img id="preview_image" width="100vw"/><br>
            Select photo to upload:
            <input type="file" id="file_to_upload" name="file_to_upload"
                   accept="image/jpeg, image/pjpeg, image/bmp, image/gif, image/jpg, image/png" required="required"
                   onchange="preview(this);"><br>
            Caption:
            <input type="text" id="caption" name="caption" required="required"><br>
            <input type="submit" value="Add to album" name="submit">
        </fieldset>
    </form>
</div>

<!-- This div contains all components related to photo display -->
<div id="display_photos">
    <?php
    while ($photo = mysqli_fetch_assoc($result_photos)) {
        ?>
        <div>
            <img width="150vw" src="<?php echo $photo['photo_name']; ?>"><br>
            <?php echo $photo['caption']; ?><br>
            <a href="delete-photo.php?id=<?php echo $photo['id']; ?>">delete</a><br>
        </div>
        <?php
    }
    ?>
</div>

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