<!DOCTYPE html>
<html lang="en-us ">
  <head>
    <title>Cloudiverse - <?php echo $page_title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/style.css');?>">
<?php
  // Custom CSS includes goes here!
  foreach ($header_CSS_inc as $stylesheet) { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet; ?>">
<?php } ?>
    <script type='text/javascript' src="<?php echo base_url('asset/js/vendor/custom.modernizr.js');?>"></script>
    <script type='text/javascript' src="<?php echo base_url('asset/js/jquery.min.js');?>"></script>
    <script type='text/javascript' src="<?php echo base_url('asset/js/header.js');?>"></script>
    <script type='text/javascript' src="<?php echo base_url('asset/js/cloudiverse.js');?>"></script>
  </head>
  <body id="<?php echo $body_ID ?>">
    <header>
<?php if($header_nav_display) { ?>      <nav class="font-signika">
        <!--Nav part of desktops-->
        <ul id="desktop-nav">
          <!--Main links-->
          <li class="font-awesome float-left current-page hide-mobile"><a href="#">&#xf015;</a></li>
          <li class="hide-for-medium-down float-left"><a href="#">Site link #1</a></li>
          <li class="hide-for-medium-down float-left"><a href="#">Site link #2</a></li>
          <!--Side links-->
          <li class="show-for-medium-down float-right hide-mobile" id="mobile-nav-grabber">
            <span class="font-awesome">&#xf039;</span>
          </li>
          <li class="hide-for-medium-down float-right not-link">
            <?php if (isset($_SESSION['user'])) {
              echo "Hello " . $_SESSION['user'];
            }?>
          </li>
          <li class="float-right" id="joyride-stop-settings">
            <a href="#"><span class="font-awesome nav-icon">&#xf013;</span><span class="hide-for-medium-down">Settings</span></a>
          </li>
          <li class="float-right" id="logout">
            <a href="<?php echo base_url('logout');?>"><span class="font-awesome nav-icon">&#xf011;</span><span class="hide-for-medium-down">Logout</span></a>
          </li>
        </ul>
        <!--Nav part for mobile-->
        <ul id="mobile-nav" style="display: none">
          <div id="mobile-nav-close" class="font-awesome">&#xf00d;</div>
          <!--Leave this blank, it will be filled up later on by jQuery.-->
        </ul>
      </nav><?php } ?>
    </header>
