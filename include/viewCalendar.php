<!-- Web Apps Test PHP Functions

<iframe src="https://www.google.com/calendar/embed?src=tesicalendar2015%40gmail.com&ctz=America/New_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home Page</title>
    <script src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="joinscript.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/yeti/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>

<body>
		<nav class="navbar navbar-default">
		<div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="index.php">T E S I</a>
		</div>
		<div>
		  <ul class="nav navbar-nav">
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="joinform.php">Sign Up</a></li>
			<li><a href="viewCalendar.php">Events</a></li>
			<li><a href="#">News</a></li>
			
		  </ul>
		</div>
		</div>
		</nav>
		
	<iframe src="https://www.google.com/calendar/embed?src=tesicalendar2015%40gmail.com&ctz=America/New_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>

</body>
</html>

<?php

include(__DIR__.'/google-api-php-client/src/Google/autoload.php'); 
define('SECRET_PATH', 'client_secret.json');


if ((isset($_SESSION)) && (!empty($_SESSION))) {
   echo "There are cookies<br>";
   echo "<pre>";
   print_r($_SESSION);
   echo "</pre>";
}

date_default_timezone_set('America/New_York');

//TELL GOOGLE WHAT WE'RE DOING
	$client = new Google_Client(array('use_objects' => true));
	$client->setApplicationName("My Calendar"); //DON'T THINK THIS MATTERS
	$client->setDeveloperKey('AIzaSyBPeUMzgJOLKTkFtqMpLCTMI84vz0oQcXg');
	$client->setRedirectUri('calendarops.php');
	$client->setAuthConfigFile(SECRET_PATH);
	$cal = new Google_Service_Calendar($client);
	$calendarId = 'tesicalendar2015@gmail.com';
	$params = array(
//CANT USE TIME MIN WITHOUT SINGLEEVENTS TURNED ON, IT SAYS TO TREAT RECURRING EVENTS AS SINGLE EVENTS
		'singleEvents' => true,
		'orderBy' => 'startTime',
		'timeMin' => date(DateTime::ATOM),//ONLY PULL EVENTS STARTING TODAY
		'maxResults' => 7 //ONLY USE THIS IF YOU WANT TO LIMIT THE NUMBER OF EVENTS DISPLAYED
	);
//THIS IS WHERE WE ACTUALLY PUT THE RESULTS INTO A VAR
	$events = $cal->events->listEvents($calendarId, $params);
	$calTimeZone = $events->timeZone; //GET THE TZ OF THE CALENDAR
 
//SET THE DEFAULT TIMEZONE SO PHP DOESN'T COMPLAIN. SET TO YOUR LOCAL TIME ZONE.
	date_default_timezone_set($calTimeZone);
 
 //START THE LOOP TO LIST EVENTS
foreach ($events->getItems() as $event) {
 
 //Convert date to month and day
 
	$eventDateStr = $event->start->dateTime;
	if(empty($eventDateStr)) {
		// it's an all day event
		$eventDateStr = $event->start->date;
	}
 
	$temp_timezone = $event->start->timeZone;
 //THIS OVERRIDES THE CALENDAR TIMEZONE IF THE EVENT HAS A SPECIAL TZ
	if (!empty($temp_timezone)) {
		$timezone = new DateTimeZone($temp_timezone); //GET THE TIME ZONE
		 // Set your default timezone in case your events don't have one
	} else {
		$timezone = new DateTimeZone($calTimeZone);
	}
 
	$eventdate = new DateTime($eventDateStr,$timezone);
	$link = $event->htmlLink;
	$TZlink = $link . "&ctz=" . $calTimeZone; //ADD TZ TO EVENT LINK
 //PREVENTS GOOGLE FROM DISPLAYING EVERYTHING IN GMT
	$newmonth = $eventdate->format("M");//CONVERT REGULAR EVENT DATE TO LEGIBLE MONTH
	$newday = $eventdate->format("j");//CONVERT REGULAR EVENT DATE TO LEGIBLE DAY

 ?>
 <div class="event-container">
 <div class="eventDate">
 <span class="month"><?php
 
 echo "<a href= $TZlink>" . $event->summary . "</a><br>";
 echo $newmonth . " " . $newday;
 echo "<br>". $event->description . "<br><br>";
 
 ?></span><br />
 <span class="day"><?php

 
 ?></span><span class="dayTrail"></span>
 </div>
 <div class="eventBody">
 <a href="<?php echo $TZlink;
 //ECHO DIRECT LINK TO EVENT
?>">
 
 <?php echo $event->summary; //SUMMARY = TITLE
 
 ?>
 </a>
 </div>
 </div>
 <?php
 }

 
?>