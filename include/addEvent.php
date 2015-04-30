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
	if (isset($_GET['eventTitle'])) {
		echo "Title: " . $_GET['eventTitle'];
	}
	if (isset($_GET['eventLocation'])) {
		echo "<br>Location: " . $_GET['eventLocation'];
	}
	if (isset($_GET['eventDate'])) {
		echo "<br>Date: " . $_GET['eventDate'];
	}
	if (isset($_GET['eventStart'])) {
		echo "<br>Start: " . $_GET['eventStart'];
	}

?>
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
	
	<form class="form-horizontal" role="form" method = "get">
		<div class="form-group">
			<div class="col-sm-1">
			</div>
			<div class="col-sm-6">
				<h1>Add Event Page</h1>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="school">Title:</label>
			<div class="col-sm-6">
				<input type='text' name='eventTitle' />
			</div>
		</div>
    
		<div class="form-group">
			<label class="control-label col-sm-3" for ="major">Location</label>
			<div class="col-sm-6">
				<input type='text' name='eventLocation' />
			</div>
		</div>
    
		<div class="form-group">
			<label class="control-label col-sm-3"  for ='class'>Date</label>
			<div class="col-sm-6">
				<input type='date' name='eventDate' />
		   </div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3"  for ='class'>Start Time</label>
			<div class="col-sm-6">
				<input type='time' name='eventStart' />
		   </div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3"  for ='class'>Event Description</label>
			<div class="col-sm-6">
				<textarea row = '4' cols='50' name='eventDescription'></textarea>
		   </div>
		</div>
	    <div class="form-group"> 
			<div class="col-sm-offset-3 col-sm-10">
			<input class="btn btn-default" type = 'submit' name = 'addEvent' value ='Add Event to Calendar'/>
			</div>
		</div>	
		<div class="form-group"> 
			<div class="col-sm-offset-3 col-sm-10">	
				<article id="errormessage"></article><br>
				<article id="invaliderrormessage"></article>
			</div>
		</div>
		</form>
	</div>
</body>
</html>

<?php

function addEvent($summary, $location, $startTime, $endTime) {
	session_start();
	require_once 'google-api-php-client/src/Google/autoload.php';
	require_once 'google-api-php-client/src/Google/Client.php';
	require_once 'google-api-php-client/src/Google/Service/Calendar.php';

	date_default_timezone_set('America/New_York');

	$client = '1078446578164-dileq5pq82es6m6jg0aujucn1t9cll2b.apps.googleusercontent.com';
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

	$event = new Google_Service_Calendar_Event();
	
	$event->setSummary($summary);
	$event->setLocation($location);
	
	$start = new Google_Service_Calendar_EventDateTime();
	$start->setDateTime($start);
	$start->setTimeZone('America/New_York');
	$event->setStart($start);
	
	$end = new Google_Service_Calendar_EventDateTime();
	$end->setDateTime('2015-04-29T05:00:00.000');
	$end->setTimeZone('America/New_York');
	$event->setEnd($end);
	
	$attendee1 = new Google_Service_Calendar_EventAttendee();
	$attendee1->setEmail('lifm@bc.edu');
	$attendees = array($attendee1);
	//$event->attendees = $attendees;

	$createdEvent = $service->events->insert("primary", $event);
} 

?>