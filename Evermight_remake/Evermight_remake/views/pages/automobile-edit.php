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
			<form method = "POST" action = "?controller=posts&action=validate">
			
					<td>
						<input type = "hidden" name = <?php echo $PKname; ?> value = <?php echo $idkeyVal; ?> >
						<?PHP echo $idkeyVal; ?>
					</td>
					
					<?php
					$j = 1;
					$coll = $table->getColumnName($j);
				
					while ($coll != false){
							echo 	'<td> <input type = "text" name = '. $coll . ' value = "'. $_POST[$coll] . '"> </td>';
							$j++;
							$coll = $table->getColumnName($j);
						}
					?>
				<td>
					<?php
					echo "	<input type = 'submit' value = 'Save'>";
					?>
				</td>
			</form>
			
			<form method = "POST" action = "?controller=posts&action=showAll">
				<td>
					<?php
						if ($idkeyNo === "") {
							echo '<input type = "hidden" name = ' . $PKname . ' value = "' . $idkeyVal . '">';
							$j = 1;
							$coll = $table->getColumnName($j);
							while ($coll != false){
								echo 	'<input type = "hidden" name = '. $coll . ' value = "'. $_POST[$coll] . '">';
								$j++;
								$coll = $table->getColumnName($j);
							}
						}
					echo "	<input type = 'submit' value = 'Go Back'>";
					?>
				</td>
			</form>
		</tr>

	</table>
</body>
</html>