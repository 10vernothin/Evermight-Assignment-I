<html>

<head></head>

<body>
<table>
	<form method = "POST" action = '?controller=server&action=update'>
		<thead >
			<b>CONNECT TO A SERVER</b>
		</thead>
		<tr>
			<td> Servername:</td>
			<td><input type = 'text' name = 'servername' value = "<?php echo $_POST['servername'] ?>" </td>
		</tr>
		<tr>
			<td> Username:</td>
			<td><input type = 'text' name = 'username' value = "<?php echo $_POST['username'] ?>"></td>
		</tr>
		<tr>
			<td> Password:</td>
			<td><input type = 'password' name = 'password' value = "<?php echo $_POST['password'] ?>"></td>
		</tr>
		<tr>
			<td><input type = 'submit' name = 'Enter'></td>
		</tr>
	</form>
</table>
	<?php
			if (isset($_GET['error'])) {
				echo '<span style = "color:red;">';
				echo $_POST['errors'] . '</br>';
				echo 'Please check your input and try again.</span>';
			}
				
		?>

</body>


</html>

