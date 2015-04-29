<?php 
	session_start();
	require_once 'google-api-php-client/src/Google/autoload.php';
	require_once 'google-api-php-client/src/Google/Client.php';
	require_once 'google-api-php-client/src/Google/Service/Calendar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add Event</title>
    <script src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="joinscript.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/yeti/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>

<body>

<?php
	if (isset($_POST['eventTitle']) && isset($_POST['eventLocation']) 
		&& isset($_POST['eventDate']) && isset($_POST['eventStart'])
		&& isset($_POST['eventEnd']) && isset($_POST['addEvent'])) {
			$summary = $_POST['eventTitle'];
			$location = $_POST['eventLocation'];
			$startTime = formatDate($_POST['eventDate'], $_POST['eventStart']);
			$endTime = formatDate($_POST['eventDate'], $_POST['eventEnd']);
			$description = $_POST['eventDescription'];
			addEvent($summary, $location, $startTime, $endTime, $description);
	}

?>
		<nav class="navbar navbar-default">
		<div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="index.php">T E S I</a>
		</div>
		<div>
		  <ul class="nav navbar-nav">
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="joinform.php">Sign Up</a></li>
			<li><a href="viewCalendar.php">Events</a></li>
			<li class="active"><a href="#">News</a></li>
		  </ul>
		</div>
		</div>
		</nav>
	</body>
</html>

<?php

function addEvent($summary, $location, $startTime, $endTime, $description) {
	
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

	
	// Create new Google Event
	$event = new Google_Service_Calendar_Event();
	
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

	$createdEvent = $service->events->insert("primary", $event);
} 

function formatDate($date, $time) {
	$result = $date . "T" . $time . ":00.000";
	return $result;
}

?>