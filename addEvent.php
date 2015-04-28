<?php
session_start();
require_once 'google-api-php-client/src/Google/autoload.php';
require_once 'google-api-php-client/src/Google/Client.php';
require_once 'google-api-php-client/src/Google/Service/Calendar.php';


if ((isset($_SESSION)) && (!empty($_SESSION))) {
   echo "There are cookies<br>";
   echo "<pre>";
   print_r($_SESSION);
   echo "</pre>";
}

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
echo "Authorization passed!";

?>

<?php 

    $event = new Google_Service_Calendar_Event();
	
	$event->setSummary('Halloween');
	$event->setLocation('Awesomeness');
	
	$start = new Google_Service_Calendar_EventDateTime();
	$start->setDateTime('2015-04-29T04:00:00.000');
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

?>