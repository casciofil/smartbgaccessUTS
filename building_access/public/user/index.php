<?php
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
<?php $page_title = 'Generate Code'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>


<div id="content">

  <div class="code new">
    <h1>Generate Code</h1>
    <form action="<?php echo url_for('/user/generate.php'); ?>" method="post">
      <dl>
        <dt>Visitor Name</dt>
        <dd><input type="text" name="visitor_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Visitor Surname</dt>
        <dd><input type="text" name="visitor_surname" value="" /></dd>
      </dl>
      <dl>
        <dt>Type of Code</dt>
        <dd><input type="radio" id="one_time" name="type_of_code" value="0">
        <label for="one_time">One-Time Code</label></dd>
        <dd><input type="radio" id="multi_use" name="type_of_code" value="1">
        <label for="multi_use">Multi-Use Code</label></dd>
      </dl>
      <dl>
      <dt>Expiry Date</dt>
      <dd><input type="date" id="expiry_date" name="expiry_date"></dd>
      </dl>
        <?php
        $code=gen_code();?>
      <dl>
      <dd><input type="hidden" id="code" name="code" value="<?php echo $code ?>"></dd>
      </dl>
        
      <div id="operations">
        <input type="submit" value="Generate Code" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
