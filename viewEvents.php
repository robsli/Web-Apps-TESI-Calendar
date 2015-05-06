<?php 
	session_start();
	require_once 'google-api-php-client/src/Google/autoload.php';
	require_once 'google-api-php-client/src/Google/Client.php';
	require_once 'google-api-php-client/src/Google/Service/Calendar.php';
	include 'calendarops.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Events</title>
    <script src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="joinscript.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/yeti/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="TESIadditional.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>

<body>

<?php
	include ('navbar.php');
	displayNavbar();
?>

	<div class='row'>
		<div class='col-md-1'>
		</div>
		<div class='col-md-5'>
			<h1>Upcoming Events</h1><br>
			<div class='pre-scrollable' id='scrollableregion'>
				<?php displayEvents(10); ?>
			</div>
		</div>
		<div class='col-md-5'>
			<br><br><br>
			<h3>TESI Google Calendar</h3>
			<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showCalendars=0&amp;mode=WEEK&amp;height=500&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=1078446578164-dileq5pq82es6m6jg0aujucn1t9cll2b%40developer.gserviceaccount.com&amp;color=%23865A5A&amp;ctz=America%2FNew_York"
			style=" border-width:0 " width="600" height="500" frameborder="0" scrolling="no"></iframe>
		</div>
		<div class='col-md-1'>
		</div>
	</div>

	</body>
</html>

<?php

 
?>