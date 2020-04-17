<?php
  if(!isset($page_title)) { $page_title = 'User Area'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>15 Broadway - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/style.css'); ?>" />
  </head>

  <body>
    <header>
      <h1>User Area</h1>
    </header>

    <navigation>
      <ul>
        <li><a href="<?php echo url_for('/user/index.php'); ?>">Generate code</a></li>
        <li><a href="<?php echo url_for('/user/list_codes.php'); ?>">Your Codes</a></li>
        <li><a href="<?php echo url_for('/login/logout.php'); ?>">Logout</a></li>
      </ul>
    </navigation>
