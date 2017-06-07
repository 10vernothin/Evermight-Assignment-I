<html>

<head>

	<title> Validation Page </title>

	<?php
	#SQL handler
	include ('SQLHandlerClass.php');
	
	#variable declaration
	$handlerInstance = new SQLHandler($_POST['servername'], $_POST['username'], $_POST['password']);
	$handlerInstance->selectDatabase("assignmentdatabase");
	$id_val = $_POST['automobile_id'];
	$model_val = $_POST['car_model'];
	$year_val = $_POST['manufacture_year'];
	$weight_val = $_POST['weight'];
	$email_val = $_POST['email'];
	$iserror = false;
	$error_msgs = 'Error: ';
	$regex_model_type = '((?i)mercedes(?-i)|(?i)audi(?-i)|(?i)ford(?-i)|(?i)honda(?-i)|(?i)toyota(?-i)|(?i)chevrolet(?-i))';
	
	#######validation
	
	###car_model validation
	if ($model_val == '') {
		$iserror = true;
		$error_msgs .= "Please do not leave 'Car Model' field empty. ";
	} else if (!preg_match($regex_model_type, $model_val)) {
		$iserror = true;
		echo preg_match($regex_model_type, $model_val);
		$error_msgs .= "We've never heard of that car before, please enter a valid car model. ";
	}
	
	#year validation
	if ($year_val == '') {
		$iserror = true;
		$error_msgs .= "Please do not leave 'Manufacture Year' field empty. ";
	} else if (is_numeric($year_val)) {
		$int_year = (int)$year_val;
		$float_year = (float)$year_val;

		if ($int_year != $float_year) {
				$iserror = true;
				$error_msgs .= "Please input only numeric integers in 'Manufacture Year' field. ";
		} else {
			if ($int_year < 1950 ) {
				$iserror = true;
				$error_msgs .= "Please input an integer larger than or equal to 1950 in 'Manufacture Year' field. ";
			}
		}
	} else {
			$iserror = true;
			$error_msgs .= "Please input only numeric integers in 'Manufacture Year' field. ";
	}
	
	#weight validation
	if ($weight_val == '') {
		$iserror = true;
		$error_msgs .= "Please do not leave 'Weight' field empty. ";
	} else if (is_numeric($weight_val)) {
		$f = (float)$weight_val;

		if ($f < 5.00 or $f > 10.00) {
				$iserror = true;
				$error_msgs .= "Please input a number between 5.00 to 10.00 in 'Weight' field. ";
		}
	} else {
			$iserror = true;
			$error_msgs .= "Please input only numbers in 'Weight' field. ";
	}
	
	#email validation
	if (!filter_var($email_val, FILTER_VALIDATE_EMAIL)) {
		$iserror = true;
		$error_msgs .= "Please input a valid email. (eg. Name@Domain.com) ";
	}
	

	#######SQL statement //error handling operation
	if ($iserror) {
		echo 	'<form method = "POST" action = "automobile-edit.php" id = "myform">
					<input type = "hidden" name = "automobile_id" value ='.$_POST["automobile_id"].'>
					<input type = "hidden" name = "car_model" value ="'.$_POST["car_model"].'">
					<input type = "hidden" name = "weight" value ='.$_POST["weight"].'>
					<input type = "hidden" name = "manufacture_year" value ='.$_POST["manufacture_year"].'>
					<input type = "hidden" name = "email" value ="'.$_POST["email"].'">';
					
		echo 	"	<input type = 'hidden' name = 'username' value =".$_POST['username'].">
					<input type = 'hidden' name = 'password' value =".$_POST['password'].">
					<input type = 'hidden' name = 'servername' value =".$_POST['servername'].">	
				</form>";
				

		echo 	'<script> 
						alert("'.$error_msgs.'");
						document.getElementById("myform").submit();
				</script>';

	} else {
		
		#serverinfo passthru
		echo "	<form action = 'automobile-list.php' method = 'post' id = 'new_entry'>
					<input type = 'hidden' name = 'username' value =".$_POST['username'].">
					<input type = 'hidden' name = 'password' value =".$_POST['password'].">
					<input type = 'hidden' name = 'servername' value =".$_POST['servername'].">
				</form>";
		
		if ($id_val != '') {
			$handlerInstance->insertQuery(	"UPDATE tbl_automobiles
											SET car_model = '$model_val', weight = $weight_val, manufacture_year = $year_val, sales_email = '$email_val'
											WHERE automobile_id=$id_val"
										 );
										 
			$updatedmessage = "Successfully saved in database.";
			echo 	'<script> 
						alert("'.$updatedmessage.'");
						document.getElementById("new_entry").submit();
					</script>';
		} else {
			$updatedmessage = "New Entry successfully added in database.";
			$handlerInstance->insertQuery(	"INSERT INTO tbl_automobiles (automobile_id, car_model, weight, manufacture_year, sales_email) 
											 VALUES (NULL, '$model_val', $weight_val, $year_val, '$email_val')"
										);
					
			
			echo 	'<script> 
						alert("'.$updatedmessage.'");
						document.getElementById("new_entry").submit();
					</script>';
		} 
	}
	?>
</head>
<body>



</body>
</html>