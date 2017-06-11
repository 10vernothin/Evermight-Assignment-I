<?php 

#Note: The template of this code is from http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/

/*
	This is a controller
*/

class ServerController {
	
	//this function updates the config.txt file if it is able to connect to a server, otherwise it does nothing
	public function update() {
		if (isset($_POST['servername']) and isset($_POST['username']) and isset($_POST['password'])) {
			if ((Server::testServer($_POST['servername'], $_POST['username'], $_POST['password']) === true)) {
					$f = file_get_contents(__DIR__ . "/../server_config.txt", 'r+');
					$fs = explode(' ', $f);
					$i = 0;
					while (isset($fs[$i])) {
						if (stripos($fs[$i], '$servername') !== false) {
							if (stripos($fs[$i+2], '$username') == true) {
								$fs[$i+1] .= " '" . $_POST['servername'] . "'";
							} else {
								$fs[$i+2] = "'" . $_POST['servername'] . "'";
							}
						}
						if (stripos($fs[$i], '$username') !== false) {
							if (stripos($fs[$i+2], '$password') == true) {
								$fs[$i+1] .= " '" . $_POST['username'] . "'";;
							} else {
								$fs[$i+2] = "'" . $_POST['username'] . "'";;
							}
						}
						if (stripos($fs[$i], '$password') !== false) {
							$fs[$i+2] = "'" . $_POST['password'] . "'";
						}
						$i++;
					}
					$f = implode(' ', $fs);
					
					$write = fopen(__DIR__ . "/../server_config.txt", 'w');
					fwrite($write, $f);
					fclose($write);
					$k = array_keys($_POST);
					$path = "?controller=posts&action=showAll";
					redirCarryPost($path, $k, "Server Connected to Successfully");
			}
		}
	}
}
	


#testing


?>