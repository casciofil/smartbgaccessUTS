<?php

// Include config file
require_once "../login/config.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}
?>
<?php

require_once('../../private/initialise.php');

$test = $_GET['test'] ?? '';

if($test == '404') {
  error_404();
} elseif($test == '500') {
  error_500();
} elseif($test == 'redirect') {
  redirect_to(url_for('/user/index.php'));
}
?>
<?php $page_title = 'Your Codes'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>
<div>
<?php
$sql = 'SELECT access_code, created_by, name_visitor, surname_visitor, expired FROM codes ';
$result = $link->query($sql);
if ($result->num_rows > 0) {
    echo "<table><tr><th>Code</th><th>Visitor's Name</th><th>Status</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($row["created_by"] == $_SESSION['id']){
            echo "<tr><td>".$row["access_code"]."</td><td>".$row["name_visitor"]." ".$row["surname_visitor"]."</td><td>".$row["expired"]."</td></tr>";
    }}
    echo "</table>";
} else {
    echo "0 results";
}
?>
</div>
<?php include(SHARED_PATH . '/user_footer.php'); ?>