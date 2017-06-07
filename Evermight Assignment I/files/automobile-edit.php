<html>
<head>
<title>Edit Field</title>
</head>
<body>
<table>
	<thead style = "font-weight: bold"> 
	<td> ID </td>
	<td> Car Model </td>
	<td> Weight </td>
	<td> Manufacture Year </td>
	<td> Sales Email </td>
	</thead>
	<tr>
		<form method = "POST" action = "validate-insert.php">
			<td> 
				<?php
				echo "<input type = 'hidden' name = 'automobile_id' value =".$_POST['automobile_id'].">".$_POST['automobile_id'];
				?>
			</td>
			<td> 
				<?php
				echo '<input type = "text" name = "car_model" value ="'.$_POST['car_model'].'">';
				?>
			</td>
			<td> 
				<?php
				echo "<input type = 'text' name = 'weight' value =".$_POST['weight'].">";
				?>
			</td>
			<td> 
				<?php
				echo "<input type = 'text' name = 'manufacture_year' value =".$_POST['manufacture_year'].">";
				?>
			</td>
			<td> 
				<?php
				echo "<input type = 'text' name = 'email' value =".$_POST['email'].">";
				?>
			</td>
			<td>
				<?php
				echo "	<input type = 'hidden' name = 'username' value =".$_POST['username'].">
						<input type = 'hidden' name = 'password' value =".$_POST['password'].">
						<input type = 'hidden' name = 'servername' value =".$_POST['servername'].">";
		
				echo "	<input type = 'submit' value = 'Save'>";
				?>
			</td>
		</form>
		<form method = "POST" action = "automobile-list.php">
			<td>
				<?php
				echo "	<input type = 'hidden' name = 'username' value =".$_POST['username'].">
						<input type = 'hidden' name = 'password' value =".$_POST['password'].">
						<input type = 'hidden' name = 'servername' value =".$_POST['servername'].">";
		
				echo "	<input type = 'submit' value = 'Go Back'>";
				?>
			</td>
		</form>

	</tr>
	
	<tr>
	</tr>

</table>
</body>
</html>