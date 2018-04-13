<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/30/18
 * Time: 11:39 AM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
include_once "../header_links.php";
include_once "../main_header.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
// Let's load profile data from Db
$user_id = $_SESSION['id'];
$query = "SELECT email, partner, wedding_date, wedding_city, wedding_location, name_prefix, phone_number, address FROM user WHERE id = $user_id";
$result_user_profile = mysqli_query($conn, $query);
if ($result_user_profile->num_rows > 0) {
    $user_profile = $result_user_profile->fetch_assoc();
    $email = $user_profile['email'];
    $partner = $user_profile['partner'];
    $wedding_date = $user_profile['wedding_date'];
    $wedding_date = explode(" ", $wedding_date)[0]; // date format conversion
    $wedding_city = $user_profile['wedding_city'];
    $wedding_location = $user_profile['wedding_location'];
    $name_prefix = $user_profile['name_prefix'];
    $phone_number = $user_profile['phone_number'];
    $address = $user_profile['address'];
} else {
    ?>
    <script type="text/javascript">
        alert("Something went wrong.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
        window.location.replace("edit-profile.php");
    </script>
    <?php
    die();
}
?>
<section class="profile-edit-sec">
    <button class="back-btn"><a href="../index.php">< Back</a></button>
    <div class="container form-sec">
        <form action="edit-profile-process.php" method="post">
            <h1>Profile Data</h1>
            <div class="col-sm-6">
                <fieldset>
                    <legend>Wedding details:</legend>
                    <div class="input-wrp">
                        <span>Your partner</span><br>
                        <input type="text" id="partner" name="partner" placeholder="Your partner's name"
                               value="<?php echo $partner; ?>">
                    </div>
                    <div class="input-wrp">
                        <span>Wedding date</span><br>
                        <input type="date" id="wedding_date" name="wedding_date" value="<?php echo $wedding_date; ?>">
                    </div>
                    <div class="input-wrp">
                        <span>Where are you getting married?</span><br>
                        <input type="text" id="city" name="city" placeholder="City"
                               value="<?php echo $wedding_city; ?>">
                    </div>
                    <div class="input-wrp">
                        <input type="text" id="location_name" name="location_name" placeholder="Location name"
                               value="<?php echo $wedding_location; ?>">
                    </div>
                </fieldset>
            </div>
            <div class="col-sm-6">
                <fieldset>
                    <legend>Basic account info:</legend>
                    <div class="input-wrp">
                        <span>Your name</span><br>
                        <select id="name_prefix" name="name_prefix">
                            <option value="Mr" <?php echo($name_prefix == 'MR' ? 'selected="selected"' : '') ?>>Mr
                            </option>
                            <option value="Mrs" <?php echo($name_prefix == 'MRS' ? 'selected="selected"' : '') ?>>Mrs
                            </option>
                        </select>
                    </div>
                    <div class="input-wrp">
                        <span>Phone number</span><br>
                        <input type="tel" id="phone_number" name="phone_number" placeholder="Phone number"
                               value="<?php echo $phone_number; ?>"><br>
                    </div>
                    <div class="input-wrp">
                        <span>Email</span><br>
                        <input type="email" id="email" name="email" readonly="readonly"
                               value="<?php echo $email; ?>"><br>
                    </div>
                    <div class="input-wrp">
                        <span>Mailing address</span><br>
                        <input type="text" id="address" name="address" placeholder="Mailing address"
                               value="<?php echo $address; ?>">
                    </div>
                </fieldset>
                <button class="add-btn">Submit</button>
            </div>
        </form>
    </div>

</section>
