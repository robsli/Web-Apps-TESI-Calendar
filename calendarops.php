<?php
	require_once 'google-api-php-client/src/Google/autoload.php';
	require_once 'google-api-php-client/src/Google/Client.php';
	require_once 'google-api-php-client/src/Google/Service/Calendar.php';

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
		'timeMin' => date(DateTime::ATOM),
		'maxResults' => $number
	);
	
	$events = $cal->events->listEvents($calendarId, $params);
	echo "<hr>";
	foreach ($events->getItems() as $event) {
		$eventDateStr = $event->start->dateTime;
		if(empty($eventDateStr)) {
			$eventDateStr = $event->start->date;
		}
		
		$eventdate = new DateTime($eventDateStr, new DateTimeZone('America/New_York'));
		$eventdate->setTimezone(new DateTimeZone('America/New_York'));
		$link = $event->htmlLink;
		$TZlink = $link . "&ctz=";

		$newmonth = $eventdate->format("M");//CONVERT REGULAR EVENT DATE TO LEGIBLE MONTH
		$newday = $eventdate->format("j");//CONVERT REGULAR EVENT DATE TO LEGIBLE DAY
		$newDate = $eventdate->format('l, M j  |  g:i A');

		echo "<h2><a href= $TZlink>" . $event->summary . "</a></h2>";
		echo "<h4>" . $newDate . "</h4>";
		echo "<h5>" . $event->location . "</h5>";
		echo "<br>";
		collapse($event->description);
		echo "<br><br>";
		if(isset($_SESSION['firstname']))
			echo "<button type='button' class='btn btn-primary'>RSVP</button>";
		else 
			echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#loginModal'>Log In to RSVP</button>";

		echo "<hr>";

	}
}

function displayEventsHome ($order) {
	require_once 'google-api-php-client/src/Google/Client.php';

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
		'timeMin' => date(DateTime::ATOM),
		'maxResults' => 100
	);
	
	$events = $cal->events->listEvents($calendarId, $params);
	echo "<hr>";
	$count = 0;
	foreach ($events->getItems() as $event) {
		if ($count == $order) {
			$eventDateStr = $event->start->dateTime;
			if(empty($eventDateStr)) {
				$eventDateStr = $event->start->date;
			}
			$eventdate = new DateTime($eventDateStr, new DateTimeZone('America/New_York'));
			$eventdate->setTimezone(new DateTimeZone('America/New_York'));
			$link = $event->htmlLink;
			$TZlink = $link . "&ctz=";

			$newmonth = $eventdate->format("M");//CONVERT REGULAR EVENT DATE TO LEGIBLE MONTH
			$newday = $eventdate->format("j");//CONVERT REGULAR EVENT DATE TO LEGIBLE DAY
			$newtime = $eventdate->format("g") . ":" . $eventdate->format('i') . " " . $eventdate->format('A');
			$newDate = $eventdate->format('l, M j  |  g:i A');

			echo "<h4><a href= $TZlink>" . $event->summary . "</a></h4>";
			echo "<h6><b>" . $newDate . "</b></h6>";
			echo "<h6>" . $event->location . "</h6>";
			echo "<br>";
			echo "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#modal" . $count . "'>Learn More</button>";
			echo "<br><br>";
			createModal($event->summary, $event->description, $count);
			if(isset($_SESSION['firstname']))
				echo "<button type='button' class='btn btn-primary'>RSVP</button>";
			else 
				echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#loginModal'>Log In to RSVP</button>";
			echo "<hr>";
		}
		$count ++;
	}
}

function collapse ($description) {
?>
	<a color="@link-color" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		Click here to read more!
	</a>

	<div class="collapse" id="collapseExample">
		<div class="well">
			<?php echo $description;?>
		</div>
	</div>
<?php
}

function createModal($title, $description, $count) {
?>
	<!-- Modal 1 -->
	<div id="modal<?php $count ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"><?php $title ?></h4>
		</div>
		<div class="modal-body">
			<img src="images/mit_logo.png" class="img-responsive" alt="mit_logo"/>
			<p><?php $description ?></p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>

	</div>
	</div>
  <!-- End of Modal -->
  <?php
}
?>