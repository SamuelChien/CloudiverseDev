<!DOCTYPE html>
<html lang="en-us ">
    <head>
        <title>Cloudiverse - <?php echo $pageTitle; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/foundation.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/style.css');?>">
        <script type='text/javascript' src="<?php echo base_url('asset/js/jquery.min.js');?>"></script>
        <script type='text/javascript' src="<?php echo base_url('asset/js/header.js');?>"></script>
    </head>
    <body id="<?php echo $bodyID ?>">
        <header><?php if($showNavBar) { ?>
            <nav class="font-title">
                <!--Nav part of desktops-->
                <ul id="desktop-nav">
                    <!--Main links-->
                    <li class="font-awesome float-left current-page"><a href="#">&#xf015;</a></li>
                    <li class="hide-for-small float-left"><a href="#">Site link #1</a></li>
                    <li class="hide-for-small float-left"><a href="#">Site link #2</a></li>
                    <li class="hide-for-small float-left"><a href="#">Site link #3</a></li>
                    <li class="hide-for-small float-left"><a href="#">Site link #4</a></li>
                    <!--Side links-->
                    <li class="hide-for-small float-right"><a href="#"><span class="font-awesome nav-icon">&#xf013;</span> Settings</a></li>
                    <li class="hide-for-small float-right"><a href="#"><span class="font-awesome nav-icon">&#xf011;</span> Logout</a></li>
                    <li class="show-for-small float-right" id="mobile-nav-grabber"><span class="font-awesome">&#xf039;</span></li>
                </ul>
                <!--Nav part for mobile-->
                <ul id="mobile-nav" style="display: none">
                    <div id="mobile-nav-close" class="font-awesome">&#xf00d;</div>
                    <!--Leave this blank, it will be filled up later on by jQuery.-->
                </ul>
            </nav><?php } ?>
        </header>
