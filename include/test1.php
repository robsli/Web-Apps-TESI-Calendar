<!-- Web Apps Test PHP Functions -->

<?php
 
include(__DIR__.'/google-api-php-client/src/Google/autoload.php'); 
date_default_timezone_set('America/New_York');
//TELL GOOGLE WHAT WE'RE DOING
	$client = new Google_Client();
	$client->setApplicationName("My Calendar"); //DON'T THINK THIS MATTERS
	$client->setDeveloperKey('AIzaSyAmfEhwr5Z-Zdn5vzONG42j2BRndsrmTLM');
	$cal = new Google_Service_Calendar($client);

	$calendarId = 'tesicalendar2015@gmail.com';
	$params = array(
//CAN'T USE TIME MIN WITHOUT SINGLEEVENTS TURNED ON, IT SAYS TO TREAT RECURRING EVENTS AS SINGLE EVENTS
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

	if (isset($_SESSION['token'])) {
		echo "<br>Getting Access";
		$client->setAccessToken($_SESSION['token']);
	}
	

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
		$attendee1->setEmail('attendeeEmail');
		// ...
		$attendees = array($attendee1,
						   // ...
						  );
		$event->attendees = $attendees;
		$createdEvent = $cal->events->insert('TESI Calendar', $event);

		echo $createdEvent->getId();
	
 ?>
 <div class="event-container">
 <div class="eventDate">
 <span class="month"><?php
 
 echo $newmonth . " " . $newday;
 
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