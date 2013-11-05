<!DOCTYPE html>
<html lang="en-us ">
    <head>
        <title>Cloudiverse - <?php echo $pageTitle; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/foundation.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/style.css');?>">
        <script type='text/javascript' src="<?php echo base_url('asset/js/jquery.min.js');?>"></script>
    </head>
    <body id="<?php echo $bodyID ?>">
        <header>
            <?php if($showNavBar) { ?><nav class="font-title">
                <ul>
                    <li class="font-awesome current-page"><a href="#">&#xf015;</a></li>
                    <li><a href="#">Site link #1</a></li>
                    <li><a href="#">Site link #2</a></li>
                    <li><a href="#">Site link #3</a></li>
                    <li><a href="#">Site link #4</a></li>
                </ul>
            </nav>
            <?php } ?>

        </header>
