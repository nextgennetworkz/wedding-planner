<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nishen Peiris
 * Date: 4/8/18
 * Time: 4:27 PM
 */
// Allow only logged in users
include_once "../config/validate_session.php";
if ($is_user_logged_in == "FALSE") {
    header('Location: ../index.php');
}
$user_id = $_SESSION['id'];
// Upload the Excel file
$target_dir = "../temp/";
//$target_file = $target_dir . basename($_FILES["file_to_upload"]["name"]);
$target_file = $target_dir . $user_id . ".xlsx";
$uploadOk = 1;
// Check if file already exists
if (file_exists($target_file)) {
    // If file exists, remove it
    unlink($target_file);
}
// If everything is ok, try to upload file
if (move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $target_file)) {
    echo "The file " . basename($_FILES["file_to_upload"]["name"]) . " has been uploaded.";
} else {
    ?>
    <script type="text/javascript">
        alert("Something went wrong while uploading the file.\nYou can try again or skip for now.");
        window.location.replace("overview.php");
    </script>
    <?php
    die();
}

// Read file and insert into database
require_once '../PHPExcel/Classes/PHPExcel.php';
// generate the file name to read
$file_name = $target_file;

try {
    // Create new PHPExcel object
    PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
    $objPHPExcel = PHPExcel_IOFactory::load($file_name);
} catch (Exception $e) {
    ?>
    <script type="text/javascript">
        alert("An internal server error occured.\nPlease try again later.");
        window.location.replace('overview.php');
    </script>
    <?php
    die();
}
$dataArr = array();
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle = $worksheet->getTitle();
    $highestRow = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

    for ($row = 1; $row <= $highestRow; ++$row) {
        for ($col = 0; $col < $highestColumnIndex; ++$col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            $dataArr[$row][$col] = $val;
        }
    }
}
unset($dataArr[1]); // since the first row is the header and not the actual data
$count = 0; // count successful insertions
foreach ($dataArr as $val) {
    $first_name = $val['0'];
    $last_name = $val['1'];
    $email = $val['2'];
    $address = $val['3'];
    $mobile_number = $val['4'];
    $attendance = $val['5'];

    $query = "INSERT INTO guest (first_name, last_name, email, address, mobile_number, attendance, user_id) VALUES ('$first_name', '$last_name', '$email', '$address', '$mobile_number', '$attendance', $user_id)";
    $result_insert_guest = mysqli_query($conn, $query);

    if ($result_insert_guest) {
        $count++;
    }
}

if ($count == 0) {
    ?>
    <script type="text/javascript">
        alert("Something went wrong.\nYou can try again or skip for now.\n<?php echo mysqli_error($conn); ?>");
        window.location.replace("overview.php");
    </script>
    <?php
} else {
    ?>
    <script type="text/javascript">
        alert(<?php echo $count; ?> +" guests adding succeeded.");
        window.location.replace("overview.php");
    </script>
    <?php
}