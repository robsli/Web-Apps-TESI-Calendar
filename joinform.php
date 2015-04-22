<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>TESI</title>
  <script src="jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="joinscript.js"></script>
</head>
<body>

<?php

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
				"",
				
			"Lynch School of Education" =>
				"Elementary Education, Secondary Education, Applied Psychology and Human Development,
				Interdisciplinary Majors");
				
		$classArray = array("2015","2016","2017","2018");
		?>
		
	<form method = "post" action="joinoperation.php" onsubmit="return validate();">
		<?php 
		textInput("firstname","First Name");
		textInput("lastname","Last Name"); 
		textInput("email","Email"); 
		textInput("password","Password"); 
		textInput("confirmpassword","Confirm Password");   		
		?>

		<label for ='school'>School</label>
		<select name="school" id="school">
  	  		<option value="Carroll School of Management">Carroll School of Management</option>
  	 		<option value="College of Arts and Sciences">College of Arts and Sciences</option>
  	 		<option value="Connell School of Nursing">Connell School of Nursing</option>
  	 		<option value="Lynch School of Education">Lynch School of Education</option>
		</select><br><br>
		
		<label for ='major'>Major</label>
		<select name ="major" id="major">
			<?php
			foreach ($collegeMajorArray as $school => $major){
					echo "<optgroup label='$school'>\n";
					$majorArray = explode(",",$major);
					foreach ($majorArray as $value){
						echo "\t\t<option value='$value'>$value</option>\n";
					}
					echo "</optgroup>\n\n";
			}?>
		</select>
		
		<script>
			$("#school").on("change", function() {
				$states = $("#major");
				$states.find("optgroup").hide().children().hide();
				$states.find("optgroup[label='" + this.value + "']").show().children().show();
				$states.find("optgroup[label='" + this.value + "'] option").eq(0).prop("selected", true);
			});
		</script><br><br>

		<label for ='class'>Class</label>
		<select name="class" id ="class"><?php
			echo "<option value=0> </option>\n";
			foreach ($classArray as $class){
      			echo "<option value=$class>$class</option>\n";
      			}?>;
		</select><br><br>

		<input type = 'submit' name = 'addMember' value ='Sign Up!'/><br><br>
				
		<article id="errormessage"></article><br>
		<article id="invaliderrormessage"></article>
	</form>
	
</body>
</html>
<?php

function textInput($name,$display){
	$error = $name . "error";
	if ($name!="password" && $name!="confirmpassword"){
		echo"<label for=$name>$display</label>
			<input type ='text' name = '$name' id= '$name' /><br><br>\n";
	}
	else{
		echo"<label for=$name>$display</label>
			<input type ='password' name = '$name' id= '$name' /><br><br>\n";
	}
}