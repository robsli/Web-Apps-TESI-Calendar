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
	$idNum = 0; //id number for the collapse target
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
		collapse($event->description, $idNum);
		echo "<br><br>";
		if(isset($_SESSION['firstname']))
				echo "<form method='post' action='rsvp.php'>
						<button type='submit' class='btn btn-primary'>RSVP</button>
						<input type='hidden' name='gcalid' value='".$event->getId()."'/>
					  </form>";
		else 
			echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#loginModal'>Log In to RSVP</button>";

		echo "<hr>";
		$idNum ++;

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


			createModal($event->summary, $event->description, $count);
			echo "<h4><a href= $TZlink>" . $event->summary . "</a></h4>";
			echo "<h6><b>" . $newDate . "</b></h6>";
			echo "<h6>" . $event->location . "</h6>";
			echo "<br>";
			echo "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#modal".$count."'>Learn More</button>";
			echo "<br><br>";

			if(isset($_SESSION['firstname']))
				echo "<form method='post' action='rsvp.php'>
						<button type='submit' class='btn btn-primary'>RSVP</button>
						<input type='hidden' name='gcalid' value='".$event->getId()."'/>
					  </form>";
			else 
				echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#loginModal'>Log In to RSVP</button>";
			echo "<hr>";
		}
		$count ++;
	}
}

function updateEvent($summary, $location, $startTime, $endTime, $eventID, $description) {
	
	//Set default timezone
	date_default_timezone_set('America/New_York');

	//Setup credentials
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

	$scope = new Google_Service_Calendar_AclRuleScope();
	$scope->setType('user');
	$scope->setValue( 'tesicalendar2015@gmail.com' );

	$rule = new Google_Service_Calendar_AclRule();
	$rule->setRole( 'owner' );
	$rule->setScope( $scope );

	$service = new Google_Service_Calendar($client);  
	$result = $service->acl->insert('primary', $rule);
	
	// Update Google Event
	$event = $service->events->get('primary', "$eventID");
	
	$event->setSummary($summary);
	$event->setLocation($location);
	$event->setDescription($description);
	
	$start = new Google_Service_Calendar_EventDateTime();
	$start->setDateTime($startTime);
	$start->setTimeZone('America/New_York');
	$event->setStart($start);
	
	$end = new Google_Service_Calendar_EventDateTime();
	$end->setDateTime($endTime);
	$end->setTimeZone('America/New_York');
	$event->setEnd($end);

	$createdEvent = $service->events->update("primary", $event->getId(), $event);
}

function formatDate($date, $time) {
	$result = $date . "T" . $time . ":00.000";
	return $result;
}

function formatDateUpdate($date, $time) {
	$result = $date . "T" . $time . ".000";
	return $result;
}

function collapse($description, $idNum) {

    echo "<a color='@link-color' data-toggle='collapse' href='#collapse".$idNum."' aria-expanded='false' aria-controls='collapse".$idNum."'>";
		echo "Click here to read more!
		</a>";
	
    echo "<div class='collapse' id='collapse".$idNum."'>";
	
		echo"<div class='well'>";
			echo $description;
		echo"</div>
	</div>";

}

function createModal($title, $description, $count) {
?>


<!------------------------------------!>
	<!-- Modal 1 -->
    <?php
    echo "<div id='modal".$count."' class='modal fade' role='dialog'>"; 

    ?>
	
	<div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"><?php echo $title; ?></h4>
		</div>
		<div class="modal-body">
			<!--<img src="images/mit_logo.png" class="img-responsive" alt="mit_logo"/>--!>
			<p><?php echo $description; ?></p>
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