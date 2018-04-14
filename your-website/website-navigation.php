<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/13/18
 * Time: 8:27 AM
 */
?>
<div id="couple"><?php echo $user_name . " / " . $partner; ?></div>
<div id="wedding_date"><?php echo $wedding_date; ?></div>
<!-- Links to other pages -->
<a href="home.php?user_id=<?php echo $user_id; ?>">Home</a>
<a href="photo-album.php?user_id=<?php echo $user_id; ?>">Photo album</a>
<a href="local-inventory.php?user_id=<?php echo $user_id; ?>">Local inventory</a>
<a href="foreign-inventory.php?user_id=<?php echo $user_id; ?>">Foreign inventory</a>
<h1>Welcome</h1>