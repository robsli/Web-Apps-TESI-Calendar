<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add Event Form</title>
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
<?php
	include ('navbar.php');
	displayNavbar();
?>

	<form class="form-horizontal" role="form" method = "post" action="addEvent.php">
		<div class="form-group">
			<div class="col-sm-1">
			</div>
			<div class="col-sm-6">
				<h1>Add Event Page</h1>
			</div>
		</div>
		<div class="form-group">
		  <label class="control-label col-sm-3" for="org">Organization:</label>
			<div class="col-sm-6">
			   <select name="org" id="org">
				<option value = '' selected = 'selected'>Please select an organization</option>
				<option value="BCVC">Boston College Venture Competition</option>
				<option value="CSS">Computer Science Society</option>
				<option value="GTC">Graduate Tech Club</option>
				<option value="ISA">Information Systems Academy</option>
				<option value="SEED">Social Entrepreneurs Envisioning Development </option>
				<option value="WiCS">Women in Computer Science</option>
				<option value="WIN">Women Innovators Network</option>
			   </select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="school">Title:</label>
			<div class="col-sm-4">
				<input type='text' class='form-control' name='eventTitle' />
			</div>
		</div>
    
		<div class="form-group">
			<label class="control-label col-sm-3" for ="major">Location</label>
			<div class="col-sm-4">
				<input type='text' class='form-control' name='eventLocation' />
			</div>
		</div>
    
		<div class="form-group">
			<label class="control-label col-sm-3"  for ='class'>Date</label>
			<div class="col-sm-4">
				<input type='date' class='form-control' name='eventDate' />
		   </div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3"  for ='class'>Start Time</label>
			<div class="col-sm-4">
				<input type='time' class='form-control' name='eventStart' />
		   </div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3"  for ='class'>End Time</label>
			<div class="col-sm-4">
				<input type='time' class='form-control' name='eventEnd' />
		   </div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3"  for ='class'>Event Description</label>
			<div class="col-sm-4">
				<textarea row = '4' cols='50' class='form-control' name='eventDescription'></textarea>
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