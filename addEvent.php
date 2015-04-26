<?php
error_reporting(E_ALL);
require_once 'google-api-php-client/src/Google/autoload.php';
require_once 'google-api-php-client/src/Google/Client.php';
require_once 'google-api-php-client/src/Google/Service/Calendar.php';
session_start();


if ((isset($_SESSION)) && (!empty($_SESSION))) {
   echo "There are cookies<br>";
   echo "<pre>";
   print_r($_SESSION);
   echo "</pre>";
}

date_default_timezone_set('America/New_York');

	$client = new Google_Client();
	$client->setApplicationName("My Calendar");
	$client->setClientId('1078446578164-12fldfgjdmk6tnu427tbpaisfjahrler.apps.googleusercontent.com');
	$client->setClientSecret('3x06MjfJOSPvPrgBtTaSp1mT');
	$client->setRedirectUri('urn:ietf:wg:oauth:2.0:oob');
	$client->setDeveloperKey('AIzaSyBPeUMzgJOLKTkFtqMpLCTMI84vz0oQcXg');
	$cal = new Google_Service_Calendar($client);
	
	
	if (isset($_GET['logout'])) {
	  echo "<br><br><font size=+2>Logging out</font>";
	  unset($_SESSION['token']);
	}

	if (isset($_GET['code'])) {
	  echo "<br>I got a code from Google = ".$_GET['code']; // You won't see this if redirected later
	  $client->authenticate($_GET['code']);
	  $_SESSION['token'] = $client->getAccessToken();
	  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
	  echo "<br>I got the token = ".$_SESSION['token']; // <-- not needed to get here unless location uncommented
	}

	if (isset($_SESSION['token'])) {
	  echo "<br>Getting access";
	  $client->setAccessToken($_SESSION['token']);
	} else {
		echo "<br> Failed to get access token.";
	}
	echo "Make it past all the if statements";
	echo '$client->getAccessToken is: ' . $client->getAccessToken();
	
	//if ($client->getAccessToken()) {
	// Creating a new Event
		echo "Creating event";
		$event = new Google_Service_Calendar_Event();
		$event ->setSummary('Appointment');
		$event->setLocation('Fulton Hall');
		$start = new Google_Service_Calendar_EventDateTime();
		$start->setDateTime('2015-04-22T10:00:00-07:00');
		$event->setStart($start);
		$end = new Google_Service_Calendar_EventDateTime();
		$end->setDateTime('2015-04-22T10:25:00.000-07:00');
		$event->setEnd($end);
		$attendee1 = new Google_Service_Calendar_EventAttendee();
		$attendee1->setEmail('tesicalendar2015@gmail.com');
		// ...
		$attendees = array($attendee1,
						   // ...
						  );
		$event->attendees = $attendees;
		$createdEvent = $cal->events->insert('TESI Calendar', $event);

		echo "Created event: " . $createdEvent->getId();
	
?>