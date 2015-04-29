<!-- Web Apps Test PHP Functions -->


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
			<li><a href="index.php">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="joinform.php">Sign Up</a></li>
			<li><a href="viewCalendar.php">Events</a></li>
			<li><a href="#">News</a></li>
			<li><a href="#">Member Page</a></li>
			
		  </ul>
		</div>
		</div>
		</nav>
	<iframe src="https://www.google.com/calendar/embed?src=1078446578164-dileq5pq82es6m6jg0aujucn1t9cll2b%40developer.gserviceaccount.com&ctz=America/New_York&amp;showTitle=0&amp;showPrint=0&amp;showCalendars=0&amp;
	height=450&amp;wkst=1&amp;bgcolor=%23333333&amp;src=tesicalendar2015%40gmail.com&amp;color=%231B887A&amp;ctz=America%2FNew_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>	
	
	<!--<iframe src="https://www.google.com/calendar/embed?title=TESI%20Calendar&amp;showTitle=0&amp;
	showPrint=0&amp;showCalendars=0&amp;height=450&amp;wkst=1&amp;bgcolor=%23333333&amp;
	src=tesicalendar2015%40gmail.com&amp;color=%231B887A&amp;ctz=America%2FNew_York" 
	style=" border:solid 1px #777 " width="600" height="450" frameborder="0" scrolling="no"></iframe>-->

	</body>
</html>

<?php

function displayEvents () {
	include(__DIR__.'/google-api-php-client/src/Google/autoload.php'); 
	define('SECRET_PATH', 'client_secret.json');

	date_default_timezone_set('America/New_York');

	$client = new Google_Client(array('use_objects' => true));
	$client->setApplicationName("My Calendar");
	$client->setDeveloperKey('AIzaSyBPeUMzgJOLKTkFtqMpLCTMI84vz0oQcXg');
	$client->setRedirectUri('calendarops.php');
	$client->setAuthConfigFile(SECRET_PATH);
	$cal = new Google_Service_Calendar($client);
	$calendarId = 'tesicalendar2015@gmail.com';
	$params = array(
		'singleEvents' => true, //Need to have single events turned on to use time min
		'orderBy' => 'startTime',
		'timeMin' => date(DateTime::ATOM),//ONLY PULL EVENTS STARTING TODAY
		'maxResults' => 7 //ONLY USE THIS IF YOU WANT TO LIMIT THE NUMBER OF EVENTS DISPLAYED
	);
	
	$events = $cal->events->listEvents($calendarId, $params);
	$calTimeZone = $events->timeZone; 
 
	foreach ($events->getItems() as $event) {
		$eventDateStr = $event->start->dateTime;
		if(empty($eventDateStr)) {
			$eventDateStr = $event->start->date;
		}
 
		$temp_timezone = $event->start->timeZone;
		
		if (!empty($temp_timezone)) {
			$timezone = new DateTimeZone($temp_timezone);
		} else {
			$timezone = new DateTimeZone($calTimeZone);
		}
 
		$eventdate = new DateTime($eventDateStr,$timezone);
		$link = $event->htmlLink;
		$TZlink = $link . "&ctz=" . $calTimeZone;

		$newmonth = $eventdate->format("M");//CONVERT REGULAR EVENT DATE TO LEGIBLE MONTH
		$newday = $eventdate->format("j");//CONVERT REGULAR EVENT DATE TO LEGIBLE DAY
 ?>
		<div class="event-container">
			<div class="eventDate">
				<span class="month">
<?php	 
				echo "<a href= $TZlink>" . $event->summary . "</a><br>";
				echo $newmonth . " " . $newday;
				echo "<br>". $event->description . "<br><br>";
?>
				</span><br />
				<span class="day"><?php
?>
				</span><span class="dayTrail"></span>
				</div>
				<div class="eventBody">
					<a href="<?php echo $TZlink;?>">
					<?php	echo $event->summary; ?>
					</a>
			 </div>
		 </div>
 <?php
	}
}

 
?>