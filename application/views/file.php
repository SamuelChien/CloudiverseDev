<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8" />
	  <title>Cloudiverse</title>
	  <link rel="stylesheet" href="<?php echo base_url('asset/css/jquery-ui.css'); ?>" />
	  <script src="<?php echo base_url('asset/js/jquery.min.js'); ?>"></script>
	  <script src="<?php echo base_url('asset/js/jquery-ui.min.js'); ?>"></script>
	  <link rel="stylesheet" href="<?php echo base_url('asset/css/fileCanvas.css'); ?>" />
	  <script src="<?php echo base_url('asset/js/fileCanvas.js'); ?>"></script>
	</head>
	<body>
		<button id="addFolder">AddFolder</button>
		<button id="addPDF">AddPDF</button>
		<button id="addWord">AddWord</button>
		<ul id="sortable">	
		  <li class="ui-state-default">
			<ul id="inline">
				<li id="pictures"><img class="image" src="/asset/img/folder.png"></li>
				<li id="name">Folder</li>
				<li id="time">Time</li>
			</ul>
		  </li>
		  <li class="ui-state-default">
			<ul id="inline">
				<li id="pictures"><img class="image" src="/asset/img/pdf.jpg"></li>
				<li id="name">PDF</li>
				<li id="time">Time</li>
			</ul>
		  </li>
		</ul>
	</body>
</html>