<!DOCTYPE html>
<html lang="en">
<head>
	<title>News</title>
    <script src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="joinscript.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/yeti/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="TESIadditional.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>

<body>

<?php
	include ('navbar.php');
	
	$news = array (
		"http://feeds.venturebeat.com/VentureBeat" => "VentureBeat",
		"http://feeds.feedburner.com/TechCrunch/startups" => "TechCrunch Startups",
		"http://feeds.feedburner.com/TechCrunchTV/Founder-Stories" => "TechCrunch Founder Stories",
		"http://feeds.feedburner.com/TechCrunch/fundings-exits" => "TechCrunch Fundings & Exists");
	
	/* Other sources to try:
		"http://bostinno.streetwise.co/feed/" => "BostInno"
	*/
	
	displayNavbar();
	
	// Introduction
	echo "<div class='col-md-1'></div>";
	echo "<h2>Tech and Entrepreneurship News</h2>";
	echo "<div class='col-md-1'></div>";
	echo "<p>Check out the most recent news in tech all in one place!<br><br>";

	echo "<div class='col-md-1'></div>";
	echo "<div class='col-md-11'>";
	foreach ($news as $key=>$value) {
		echo "<div class='col-md-5'>";
		echo "<h3>$value</h3>";
		echo "<div class='pre-scrollable'>";
				displayFeed($key);
		echo "</div></div>";
	}
	echo "</div>";
?>

</body>
</html>

<?php

function displayFeed($feed) {
	$rss = new SimpleXMLElement(file_get_contents($feed));
	$items = $rss -> channel -> item;
	if (!$items) {
		$items = $rss->item;
	}
	$counter = 0;
	foreach ($items as $item) {
		if ($counter <= 5) {
			echo "<hr>";
			echo "<h4><a href='" . $item->link . "'>" . $item->title . "</a></h4><br><br>";
			echo $item->description . "\n";
			$counter += 1;
			echo "<hr>";
		} else {
			break;
		}
	}
}