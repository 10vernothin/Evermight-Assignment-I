<html>

<head> 
	<title>Database Display</title>
	
	<?php
	#include files
	include ('SQLHandlerClass.php');
	
	#variable initialization
	$handlerinstance = new SQLHandler($_POST['servername'], $_POST['username'], $_POST['password']);
	$dbname = "AssignmentDatabase";
	$car_model_maxchar = 50;
	$weight_maxchar = 10;
	$email_maxchar = 50;
	
	
	#creating $tbl_automobiles

	$handlerinstance->createDatabase($dbname, 0)->selectDatabase($dbname);
	$createTable = "CREATE TABLE tbl_automobiles (
						automobile_id 		INT 	NOT NULL	 AUTO_INCREMENT,
						car_model 			VARCHAR ($car_model_maxchar),
						weight 				DECIMAL ($weight_maxchar, 2),
						manufacture_year	YEAR,
							PRIMARY KEY (automobile_id)
					)";
	$emailinsertcolumn = "ALTER TABLE tbl_automobiles ADD sales_email VARCHAR($email_maxchar) NOT NULL;";
	$handlerinstance->insertQuery($createTable);
	
	#PART II: Add email column
	$handlerinstance->insertQuery($emailinsertcolumn);
	
	#examples
	#$insertExample = "INSERT INTO tbl_automobiles (automobile_id, car_model, weight, manufacture_year, sales_email) 
	#					VALUES (1, 'Corolla', 5.00, 2000, 'laffytaffy@duckdodgers.com')";
	#$insertExample2 = "INSERT INTO tbl_automobiles (automobile_id, car_model, weight, manufacture_year, sales_email) 
	#					VALUES (2, 'Tesla', 7.00, 2000, 'duckdodgers@yahoo.com')";
	#$handlerinstance->insertQuery($insertExample)->insertQuery($insertExample2);
	?>

</head>

<body>
	
	<table>
        <thead style = "font-weight: bold">
            <td>ID</td>
            <td>Car Model</td>
            <td>Weight</td>
			<td>Manufacture Year </td>
			<td>Sales Email </td>
			<td></td>
        </thead >
        <?php
			$i = 1;
			$extract_row= "Select * from tbl_automobiles WHERE automobile_id=$i";
			while($row = $handlerinstance->insertQueryReturnResult($extract_row)->fetch_array()) {
			echo "<tr>
					<form action = 'automobile-edit.php' method = 'POST'>
						<td> <input type = 'hidden' name = 'automobile_id' value =".$row['automobile_id'].">".$row['automobile_id']."</td>";
			echo '		<td> <input type = "hidden" name = "car_model" value = "'.$row['car_model'].'">'.$row['car_model']."</td>";
			echo "		<td> <input type = 'hidden' name = 'weight' value =".$row['weight'].">".$row['weight']."</td>
						<td> <input type = 'hidden' name = 'manufacture_year' value =".$row['manufacture_year'].">".$row['manufacture_year']."</td>
						<td> <input type = 'hidden' name = 'email' value =".$row['sales_email'].">".$row['sales_email']."</td>
						<td><input type = 'submit' value = 'Edit'> </td>";
			
			#server info passthru
			echo "		<input type = 'hidden' name = 'username' value =".$_POST['username'].">
						<input type = 'hidden' name = 'password' value =".$_POST['password'].">
						<input type = 'hidden' name = 'servername' value =".$_POST['servername'].">
					</form>	
				</tr>";
			
			$i++;
			$extract_row= "Select * from tbl_automobiles WHERE automobile_id=$i";
			}

        ?>
		<tr>
			<form action = "automobile-edit.php" method = "POST">
				<td><input type = 'hidden' name = 'automobile_id' value = "">NEW ENTRY:</td>
				<td><input type = 'text' name = 'car_model' value =""> </td>
				<td><input type = 'text' name = 'weight' value =""></td>
				<td><input type = 'text' name = 'manufacture_year' value =""></td>
				<td><input type = 'text' name = 'email' value =""></td>
				<td><input type = 'submit' value = 'Edit'></td>
			<?php
			echo "	<input type = 'hidden' name = 'username' value =".$_POST['username'].">
					<input type = 'hidden' name = 'password' value =".$_POST['password'].">
					<input type = 'hidden' name = 'servername' value =".$_POST['servername'].">";
			?>
			</form>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>
		<a href = "../../Evermight Assignment I/Start.php"> <button>Exit Database</button> </a>
			</td>
		</tr>
    </table>
</body>
</html>