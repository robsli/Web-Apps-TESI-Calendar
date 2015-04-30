<?php

function displayEvents ($number) {

	date_default_timezone_set('America/New_York');

	$client_id = '1078446578164-dileq5pq82es6m6jg0aujucn1t9cll2b.apps.googleusercontent.com';
	$service_email = '1078446578164-dileq5pq82es6m6jg0aujucn1t9cll2b@developer.gserviceaccount.com';
	$keyFileLocation = 'TESI Calendar-1ab97ed7c865.p12';
	$client = new Google_Client();
	$client->setApplicationName("TESI Calendar");
	$key = file_get_contents($keyFileLocation);
	$scopes = "https://www.googleapis.com/auth/calendar";
	$cred = new Google_Auth_AssertionCredentials(
		$service_email,
		array($scopes),
		$key);
	$client->setAssertionCredentials($cred);
	if($client->getAuth()->isAccessTokenExpired()) {	 	
		$client->getAuth()->refreshTokenWithAssertion($cred);	 	
	}	 	
	$cal = new Google_Service_Calendar($client);
	$calendarId = '1078446578164-dileq5pq82es6m6jg0aujucn1t9cll2b@developer.gserviceaccount.com';
	$params = array(
		'singleEvents' => true, //Need to have single events turned on to use time min
		'orderBy' => 'startTime',
		'timeMin' => date(DateTime::ATOM),//ONLY PULL EVENTS STARTING TODAY
		'maxResults' => $number //ONLY USE THIS IF YOU WANT TO LIMIT THE NUMBER OF EVENTS DISPLAYED
	);
	
	$events = $cal->events->listEvents($calendarId, $params);
 
	foreach ($events->getItems() as $event) {
		$eventDateStr = $event->start->dateTime;
		if(empty($eventDateStr)) {
			$eventDateStr = $event->start->date;
		}
		date_default_timezone_set('America/New_York');
 
		$eventdate = new DateTime($eventDateStr, new DateTimeZone('America/New_York'));
		$link = $event->htmlLink;
		$TZlink = $link . "&ctz=";

		$newmonth = $eventdate->format("M");//CONVERT REGULAR EVENT DATE TO LEGIBLE MONTH
		$newday = $eventdate->format("j");//CONVERT REGULAR EVENT DATE TO LEGIBLE DAY
		$newtime = $eventdate->format("g") . ":" . $eventdate->format('i') . " " . $eventdate->format('A');
		$newDate = $eventdate->format('M j  |  g:i A');
 ?>
		<div class="eventDate">
			<span class="month">
<?php	 
<<<<<<< HEAD
			echo "<h2><a href= $TZlink>" . $event->summary . "</a></h2>";
			echo "<h4>" . $newDate . "</h4>";
			echo "<h5>" . $event->location . "</h5>";
			echo "<br>". $event->description . "<br><br>";
=======
				echo "<h2><a href= $TZlink>" . $event->summary . "</a></h2>";
				echo "<h4>" . $newDate . "</h4>";
				echo "<h5>" . $event->location . "</h5>";
				echo "<br>";
				collapse($event->description);
>>>>>>> f1da2d38cf8d01e53e390e8f6ecf2194d320464e
?>
		</div>
		<hr>
 <?php
	}
}

?>
<?php
function collapse ($event) {
?>
<a color="@link-color" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Click here to read more!
</a>

</button>
<div class="collapse" id="collapseExample">
  <div class="well">
    <?php echo $event;?>
  </div>
</div>
<?php
}
?>