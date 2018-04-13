<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/12/18
 * Time: 5:35 PM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id']; // currently logged in user
// Let's load website settings from the database.
// Here, if a theme is not set for the website, we consider 'blue theme' as the default theme.
$query_fetch_website_theme = "SELECT value FROM website_settings WHERE user_id = $user_id AND setting = 'website.theme';";
$result_website_theme = mysqli_query($conn, $query_fetch_website_theme);
$website_theme = mysqli_fetch_assoc($result_website_theme)['value'];
?>
<h1>Your website</h1>
<!-- Link to view the website -->
<a href="">View website</a>
<!-- Website settings form -->
<form id="website_settings_form" name="website_settings_form" action="update-website-settings-process.php"
      method="post">
    <fieldset>
        <legend>Your website settings</legend>
        <img id="preview_website_theme" width="100vw"><br>
        Theme of the website:
        <select id="website_theme" name="website_theme" onchange="previewTheme()">
            <option value="blue_theme" <?php echo($website_theme == 'blue_theme' ? 'selected="selected"' : '') ?>>Blue
                theme
            </option>
            <option value="green_theme" <?php echo($website_theme == 'green_theme' ? 'selected="selected"' : '') ?>>
                Green theme
            </option>
        </select><br>
        <input type="submit" value="Save">
    </fieldset>
</form>

<!-- Function to display a preview of the selected theme -->
<script type="text/javascript">
    // Let's do these things after the page is loaded
    window.onLoad = previewTheme();

    function previewTheme() {
        var input = document.getElementById("website_theme");
        var theme = (input.value || input.options[input.selectedIndex].value);  //cross-browser solution
        var preview;
        if (theme == "blue_theme") {
            preview = "../img/blue_theme.png";
        } else if (theme == "green_theme") {
            preview = "../img/green_theme.png";
        }
        document.getElementById("preview_website_theme").setAttribute("src", preview);
    }
</script>