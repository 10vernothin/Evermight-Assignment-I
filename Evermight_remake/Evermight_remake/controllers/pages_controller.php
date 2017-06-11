<?php 

#Note: The template of this code is from http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/

/*
	This is a model
*/

class PagesController {
	
	//this function directs to the starting "Connect to a Server" page, with default input
	public function start() {
		if (!isset($_POST['servername'])){
			$_POST['servername'] = 'localhost:3306';
		}
		if (!isset($_POST['username'])){
			$_POST['username'] = 'root';
		}
		if (!isset($_POST['password'])){
			$_POST['password'] = '';
		}
		require_once('views/pages/start.php');
		
	}
	
	//this function directs to the error page
	public function error() {
		require_once('views/pages/error.php');
	}

}


#testing


?>