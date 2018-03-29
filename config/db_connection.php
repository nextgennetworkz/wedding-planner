<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 3/24/18
 * Time: 3:01 PM
 */
$host = "localhost";
$db_user = "root";
$db_pass = "gvt123";
$database = "WEDDING_PLANNER";

$conn = mysqli_connect("$host", "$db_user", "$db_pass", "$database") or

die("Database server error " . mysqli_error($conn));