<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/29/18
 * Time: 10:36 AM
 */
session_start();
session_unset(); // remove all session variables
session_destroy(); // destroy the session
header('Location: /wedding-planner/index.php'); // redirect to home