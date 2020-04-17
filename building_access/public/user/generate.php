<?php
// Include config file
require_once "../login/config.php";
require_once "../../private/initialise.php";

session_start();
// This function will run within each post array including multi-dimensional arrays 
function ExtendedAddslash(&$params) 
{ 
        foreach ($params as &$var) { 
            // check if $var is an array. If yes, it will start another ExtendedAddslash() function to loop to each key inside. 
            is_array($var) ? ExtendedAddslash($var) : $var=addslashes($var); 
            unset($var); 
        } 
} 

// Initialize ExtendedAddslash() function for every $_POST variable 
ExtendedAddslash($_POST);      

$code_gn = $_POST['code'];
$created_by_gn = $_SESSION['id'];
$name_visitor_gn = $_POST['visitor_name'];
$surname_visitor_gn = $_POST['visitor_surname'];
$type_of_code_gn = $_POST['type_of_code'];
$expiry_date_gn = $_POST['expiry_date'];
$expired_gn = "0";


mysqli_query($link, "INSERT INTO codes (access_code, created_by, name_visitor, surname_visitor, type_of_code, expiry_date, expired) 
                            VALUES ('$code_gn', '$created_by_gn', '$name_visitor_gn', '$surname_visitor_gn', '$type_of_code_gn', '$expiry_date_gn', '$expired_gn') ") 
or die(mysqli_error($link));  

redirect_to(url_for('/user/list_codes.php'))
?>