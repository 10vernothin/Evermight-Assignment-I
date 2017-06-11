<?php
	//this function redirects the page to a location and imports all $_POST values on that page to the location. 
	//Also allowed to show an alert before the page redirect
	function redirCarryPost($location, $postkeys, $alert = false) {
		echo "Connecting. Please wait...";
		echo '<form id = "redir" action = ' . $location . ' method = "POST">';
		foreach ($postkeys as $keyval) {
			if (!(($_POST["$keyval"] == "Submit") or ($_POST["$keyval"] == "submit"))){
				echo "<input type = hidden name = ". $keyval . " value = " . $_POST["$keyval"] . " >";
			}
		}
		echo '<input type = "submit" style="display: none;">';
		echo '</form>';
		echo '<script>'; 
		if ($alert != false) {
			echo 'alert("'. $alert .'");';
		}
		echo "document.getElementById('redir').submit();
			  </script>";
	}
	
	
	//this function will redirect the page to a location with an alert, with no $_POST values
	function redir($location, $alert = false) {
		echo '<form id = "redir" action = ' . $location . ' method = "POST">';
		echo '<input type = "Submit" style="display: none;">';
		echo '</form>';
		echo '<script>'; 
		if ($alert != false) {
			echo 'alert("'. $alert .'");';
		}
		echo "document.getElementById('redir').submit();
			  </script>";
	}
?>