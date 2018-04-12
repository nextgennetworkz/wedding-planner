<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/12/18
 * Time: 10:36 AM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id']; // current users's id
$target_dir = "../photos/";
$imageFileType = strtolower(pathinfo(basename($_FILES["file_to_upload"]["name"]), PATHINFO_EXTENSION));
$target_file = $target_dir . uniqid(time()) . "." . $imageFileType;
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file_to_upload"]["tmp_name"]);
    if ($check !== false) {
    } else {
        ?>
        <script type="text/javascript">
            alert("The file you uploaded is not a valid image.\nYou can try again or skip for now.");
            window.location.replace("overview.php");
        </script>
        <?php
        die();
    }
}
// Check file size
if ($_FILES["file_to_upload"]["size"] > 500000) {
    ?>
    <script type="text/javascript">
        alert("The photo you uploaded is too large.\nYou can try again or skip for now.");
        window.location.replace("overview.php");
    </script>
    <?php
    die();
}
// Allow certain file formats
if ($imageFileType != "jpeg" && $imageFileType != "pjpeg" && $imageFileType != "bmp" && $imageFileType != "gif" && $imageFileType != "jpg" && $imageFileType != "png") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    ?>
    <script type="text/javascript">
        alert("Sorry, only JPEG, PJPEG, BMP, GIF, JPG, & PNG files are allowed.\nYou can try again or skip for now.");
        window.location.replace("overview.php");
    </script>
    <?php
    die();
}
// If everything is ok, try to upload the photo
if (move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $target_file)) {
    // Let's persist photo information in the database
    $caption = $_POST['caption']; // get caption from POST request
    $query = "INSERT INTO wedding_album (user_id, caption, photo_name) VALUES ($user_id, '$caption', '$target_file');";
    $result_insert_photo = mysqli_query($conn, $query);
    // Alert and redirect
    if ($result_insert_photo) {
        ?>
        <script type="text/javascript">
            alert("Photo upload succeeded.");
            window.location.replace("overview.php");
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert("Something went wrong while persisting photo details.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
            window.location.replace("overview.php");
        </script>
        <?php
    }
} else {
    echo $target_file;
    ?>
    <script type="text/javascript">
        alert("Something went wrong while uploading your photo.\nYou can try again or skip for now.\n");
        window.location.replace("overview.php");
    </script>
    <?php
}
?>
<!-- Let's add a loader to show the file upload progress -->