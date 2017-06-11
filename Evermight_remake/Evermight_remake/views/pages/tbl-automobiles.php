<html>

<head></head>

<body>
<table>
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
			$i = 0;
			$j = 0;
			$ent = $table->getEntryRow($i);
			$coll = $table->getColumnName($j);
			
			while ($ent != false) {
				echo "<tr> <form action = '?controller=posts&action=edit' method = 'POST'>";	
				while ($coll != false){
					echo "<td> <input type = 'hidden'";
					echo	'name = "' . $coll . '" value = "'. $table->fetchByArrayOrder($i, $j) . '">' . $table->fetchByArrayOrder($i, $j) . '</td>';
					$j++;
					$coll = $table->getColumnName($j);
				}
					echo	"
								<td><input type = 'submit' name = 'edit' value = 'Edit'></td>
								</form></tr>
								" ;
				$j = 0;
				$i++;
				$coll = $table->getColumnName($j);
				$ent = $table->getEntryRow($i);
			}
			if ($i = 0 and $j = 0) {
				echo "There are no entries yet. =(";
			}
			
        ?>
		<tr>
			<form action = '?controller=posts&action=edit' method = 'POST'>
				<td>
				NEW ENTRY:
				<input type = 'hidden' name = "<?php $table->getColumnName(0) ?>" value = "">
				</td>
			<?php 
				$j = 1;
				while ($table->getColumnName($j)){
						echo "<td> <input type = 'text' name = ". $table->getColumnName($j) ;
						echo		' value = "'. $colval[$j] .'"> </td>';
						$j++;
					}
					echo	'<td><input type = "submit" name = "create" value = "Edit"> </td>'
				?>
			</form>
		</tr>
		<tr>
			<td>
				<a href = "?" ><button> Exit </button> </a>
			</td>
		</tr>
</table>


</body>


</html>

