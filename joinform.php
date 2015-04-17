<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>TESI</title>
  <script src="jquery-1.11.2.min.js"></script>
  <!--<script type="text/javascript" src="myscripts.js"></script>-->
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
		
	<form method = "post" action="../include/locationoperation.php" onsubmit="return validate();">

		<label for='name'>First Name </label>
		<input type = 'text' name = 'firstname' id='firstname' />
		<article id="firstnameerror"></article><br>
		
		<label for='name'>Last Name </label>
		<input type = 'text' name = 'lastname' id='lastname' />
		<article id="lastnameerror"></article><br>
		
		<label for ='category'>Email </label>
		<input type = 'text' name = 'email' id='email' />
		<article id="emailerror"></article><br>
		
		<label for ='address'>Password </label>
		<input type = 'password' name = 'password' id='password' />
		<article id="passworderror"></article><br>
	
		<label for ='school'>School</label>
		<select name="school" id ="school"><?php
			//echo "<option value=0 selected>Select one</option>";
			$count = 1;
			foreach ($collegeMajorArray as $school => $major){
      			echo "<option value=$count>$school</option>";
      			$count++;
      			}?>;
		</select>
		<article id="schoolerror"></article><br>
		
		<label for ='major'>Major</label>
		<select name="major" id ="major"><?php
			//echo "<option value=0> </option>";
			$count = 1;
			foreach ($collegeMajorArray as $school => $major){
				$majorArray = explode(",",$major);
      			foreach ($majorArray as $value){
      				echo "<option value=$count>$value</option>";
      			}
      			echo"\n";
      			$count++;
      		}?>;
		</select>
		<article id="majorerror"></article><br>
		
		<script>
			$("#school").change(function() { 
			if($(this).data('options') == undefined){
				/*Takes an array of all majors and kind of embeds it on the school*/
				$(this).data('options',$('#major option').clone());
				} 
			var id = $(this).val();
			var options = $(this).data('options').filter('[value=' + id + ']');
			$('#major').html(options);
			});
		</script>
		
		<label for ='class'>Class</label>
		<select name="class" id ="class"><?php
			$count = 4;
			foreach ($classArray as $class){
      			echo "<option value=$count>$class</option>";
      			$count--;
      			}?>;
		</select>
		<article id="classerror"></article><br>
	
		<input type = 'submit' name = 'add' value ='Sign Up!'/>
	</form>
	
</body>
</html>