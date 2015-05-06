<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Form</title>
    <script src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="joinscript.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/yeti/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<body>

<?php
		
	include ('navbar.php');
	include ('dboperation.php');
	displayNavbar();
	
	$dbc = connecttoDB("lifm", "qmJriism", "lifm");
	
	$tablequery = "SELECT * FROM TESI_EVENTS"; 
	$tableresult = mysqli_query($dbc, $tablequery);

	echo "<div class='col-md-1'></div>";
	echo "<div class='container'>";
	echo"<h2>TESI Events</h2>";
	echo "<table id = 'managerTable' class='table table-striped'>";
	$color = 'white';
	echo"<tr style ='background-color:$color'>
		<th>ID</th>
		<th>Club</th>
		<th>Title</th>
    	<th>Location</th>
    	<th>Date</th>
    	<th>Start Time</th>
    	<th>End Time</th></tr>";
	while($row = mysqli_fetch_array($tableresult, MYSQLI_ASSOC)){   //Creates a loop to loop through results
		echo "<tbody>";
		echo "<tr style='background-color: $color'><td>" . $row['ID'] . "</td><td>" . $row['club'] . "</td><td>" . $row['title'] . "</td><td>"
					. $row['location'] . "</td><td>" . $row['dateofvisit'] . "</td><td>" . $row['starttime'] . "</td><td>" 
					. $row['endtime'] . "</td></tr>";
		echo "</tbody>";  
	}
	echo "</table></div><br>"; ?>

	<form class="form-horizontal" role="form" method = "post" action="managerOperation.php">
		<input type="hidden" name="ID" id="ID"/>
		
		<div class="form-group">
		  <label class="control-label col-sm-3" for="club">Organization:</label>
			<div class="col-sm-6">
			   <select name="club" id="club">
				<option value = 'default' selected = 'selected'>Please select an organization</option>
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
		
		<?php
		textInput("title","Title",'text');
		textInput("location","Location",'text'); 
		textInput("date","Date",'date'); 
		textInput("starttime","Start Time",'time'); 
		textInput("endtime","End Time",'time'); 
		?>
    
		<div class="col-sm-offset-3 col-sm-10">
     		<input class="btn btn-default" type = "reset" name = 'reset' value  = 'Reset'/>
			<input class="btn btn-default" type = 'submit' name = 'changerecord' value = 'Change Record'/>
		</div>
    
    </form>
    
	
	<script>
		(function () {
			if (window.addEventListener) {
				window.addEventListener('load', run, false);
			} else if (window.attachEvent) {
				window.attachEvent('onload', run);
			}

		function run() {
			var t = document.getElementById('managerTable');
			var rows = t.rows; //rows collection - https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement
			for (var i=0; i<rows.length; i++) {
				rows[i].onclick = function (event) {
					//event = event || window.event; // for IE8 backward compatibility
					//console.log(event, this, this.outerHTML);
					if (this.parentNode.nodeName == 'THEAD') {
						return;
					}
					var cells = this.cells; //cells collection
					var f0 = document.getElementById('ID');
					var f1 = document.getElementById('club');
					var f2 = document.getElementById('title');
					var f3 = document.getElementById('location');
					var f4 = document.getElementById('date');
					var f5 = document.getElementById('starttime');
					var f6 = document.getElementById('endtime');
					f0.value = cells[0].innerHTML;
					f1.value = cells[1].innerHTML;
					f2.value = cells[2].innerHTML;
					f3.value = cells[3].innerHTML;
					f4.value = cells[4].innerHTML;
					f5.value = cells[5].innerHTML;
					f6.value = cells[6].innerHTML;
					};
				}
			}
		})();
		
		$('table tr').each(function(a,b){
			$(b).click(function(){
				 $('table tr').css('background','white');
				 $(this).css('background','lightgrey');   
			});
		});
		
    	</script>
    	
</body>
</html>

<?php

function textInput($name,$display,$type){
	$error = $name . "error";
	?><div class="form-group">
	<?php
	   if ($name!="password" && $name!="confirmpassword"){
		echo"<label class='control-label col-sm-3' for=$name>$display</label>
		    <div class='col-sm-6'>
			<input class='form-control' type = '$type' name = '$name' id= '$name' /></div>\n";
	}
	else{
		echo"<label class='control-label col-sm-3' for=$name>$display</label>
		    <div class='col-sm-6'>
			<input class='form-control' type ='password' name = '$name' id= '$name' /></div>\n";
	}
	?></div><?php
}