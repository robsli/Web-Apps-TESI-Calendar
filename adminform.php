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
	include 'dboperation.php';
	//Set default timezone
	date_default_timezone_set('America/New_York');

	$collegeMajorArray = 
		array(
			"Carroll School of Management" =>
				"Accounting, Information Systems, Business Analytics, 
				Corporate Reporting and Analysis, Computer Science, Economics, Finance, 
				General Management, Information Systems, Management and Leadership, 
				Marketing, Operations Management",
				
			"College of Arts and Sciences" =>
				"Art, History, Biochemistry, Biology, Chemistry, Classical Studies, Communication, 
				Computer Science, Earth and Environmental Sciences, Economics, English, 
				Environmental Geoscience, Environmental Studies, Film Studies, French, 
				Geological Sciences, German Studies, Hispanic Studies, History, Independent Major,
				International Studies, Islamic Civilization and Societies, Italian, Linguistics,
				Mathematics, Music, Philosophy, Physics, Political Science, Psychology, Russian, 
				Slavic Studies, Sociology, Studio Art, Theater, Theology",
				
			"Connell School of Nursing" =>
				"Nursing",
				
			"Lynch School of Education" =>
				"Elementary Education, Secondary Education, Applied Psychology and Human Development,
				Interdisciplinary Majors");
				
		$classArray = array(date("Y"),date("Y")+1,date("Y")+2,date("Y")+3);
		
	include ('navbar.php');
	displayNavbar();
	
	$dbc = connecttoDB("lifm", "qmJriism", "lifm");
	
	$tablequery = "SELECT * FROM TESI_MEMBERSHIP"; 
	$tableresult = mysqli_query($dbc, $tablequery);
	
	echo "<div class='col-md-1'></div>";
	echo "<div class='container'>";
	echo"<h2>TESI Membership</h2>";
	echo "<table id = 'adminTable' class='table table-striped'>";
	$color = 'white';
	echo"<tr style ='background-color:$color'>
		<th>ID</th>
		<th>First Name</th>
    	<th>Last Name</th>
    	<th>Email</th>
    	<th>School</th>
    	<th>Major</th>
    	<th>Class Year</th>
    	<th>Membership Type</th></tr>";
	while($row = mysqli_fetch_array($tableresult, MYSQLI_ASSOC)){   //Creates a loop to loop through results
		echo "<tbody";
		echo "<tr style='background-color: $color'><td>" . $row['ID'] . "</td><td>" . $row['firstname'] . "</td><td>" . $row['lastname'] . "</td><td>"
					. $row['email'] . "</td><td>" . $row['school'] . "</td><td>" . trim($row['major']) . "</td><td>"
					. $row['classyear'] . "</td><td>" . $row['membershiptype'] . "</td></tr>";
		echo "</tbody>";  
	}
	echo "</table></div><br>"; ?>

	<form class="form-horizontal" role="form" method = "post" action="adminoperation.php">
		<input type="hidden" name="ID" id="ID"/>
		<?php
		textInput("firstname","First Name");
		textInput("lastname","Last Name"); 
		textInput("email","Email"); 
		?>
		<!--School <input type="text" id="school" /><br>
		Major <input type="hidden" id="major" /><br>
		Class Year<input type="hidden" id="classyear" /><br>
		Membership Type<input type="hidden" id="membershiptype" /><br><br>
		<input type="reset" value="Reset"><br>-->
	
	 <div class="form-group">
      <label class="control-label col-sm-3" for="school">School:</label>
      <div class="col-sm-6">
           <select name="school" id="school">
            <option value="">Select School</option>
  	  		<option value="Carroll School of Management">Carroll School of Management</option>
  	 		<option value="College of Arts and Sciences">College of Arts and Sciences</option>
  	 		<option value="Connell School of Nursing">Connell School of Nursing</option>
  	 		<option value="Lynch School of Education">Lynch School of Education</option>
	       </select>
       </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-3" for ="major">Major</label>
		<div class="col-sm-6">
			<select name ="major" id="major">
			<?php
				foreach ($collegeMajorArray as $school => $major){
					echo "<optgroup label='$school'>\n";
					$majorArray = explode(",",$major);
					foreach ($majorArray as $value){
						echo "\t\t<option value='$value'>$value</option>\n";
					}
					echo "</optgroup>\n\n";
				}
			?>
			</select>
		<script>
			$("#school").on("change", function() {
				$states = $("#major");
				$states.find("optgroup").hide().children().hide();
				$states.find("optgroup[label='" + this.value + "']").show().children().show();
				$states.find("optgroup[label='" + this.value + "'] option").eq(0).prop("selected", true);
			});
		</script>
       </div>
	</div>

	<div class="form-group">
		<label class="control-label col-sm-3"  for ='class'>Class</label>
		<div class="col-sm-6">
			<select name="class" id ="class">
			<?php
				echo "<option value=''>Class Year</option>\n";
				foreach ($classArray as $class){
					echo "<option value=$class>$class</option>\n";
				}
			?>;
			</select>
		</div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-3"  for ='membershiptype'>Membership Type</label>
      <div class="col-sm-6">
           <select name="membershiptype" id ="membershiptype"><?php
           echo "<option value=''>Membership Type</option>\n";
           echo "<option value= 'general' >General</option>\n";
           echo "<option value= 'manager' >Manager</option>\n";
           echo "<option value= 'admin' >Admin</option>\n";?>
		</select>
       </div>
    </div>
    
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
			var t = document.getElementById('adminTable');
			var rows = t.rows; //rows collection - https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement
			for (var i=0; i<rows.length; i++) {
				rows[i].onclick = function (event) {
					//event = event || window.event; // for IE8 backward compatibility
					//console.log(event, this, this.outerHTML);
					if (this.parentNode.nodeName == 'THEAD') {
						return;
					}
					var cells = this.cells; //cells collection
					var space = " ";
					var f0 = document.getElementById('ID');
					var f1 = document.getElementById('firstname');
					var f2 = document.getElementById('lastname');
					var f3 = document.getElementById('email');
					var f4 = document.getElementById('school');
					var f5 = document.getElementById('major');
					var f6 = document.getElementById('class');
					var f7 = document.getElementById('membershiptype');
					f0.value = cells[0].innerHTML;
					f1.value = cells[1].innerHTML;
					f2.value = cells[2].innerHTML;
					f3.value = cells[3].innerHTML;
					f4.value = cells[4].innerHTML;
					f5.value = space.concat(cells[5].innerHTML);
					f6.value = cells[6].innerHTML;
					f7.value = cells[7].innerHTML;
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
function textInput($name,$display){
	$error = $name . "error";
	?><div class="form-group">
	<?php
	   if ($name!="password" && $name!="confirmpassword"){
		echo"<label class='control-label col-sm-3' for=$name>$display</label>
		    <div class='col-sm-6'>
			<input class='form-control' type ='text' name = '$name' id= '$name' /></div>\n";
	}
	else{
		echo"<label class='control-label col-sm-3' for=$name>$display</label>
		    <div class='col-sm-6'>
			<input class='form-control' type ='password' name = '$name' id= '$name' /></div>\n";
	}
	?></div><?php
}