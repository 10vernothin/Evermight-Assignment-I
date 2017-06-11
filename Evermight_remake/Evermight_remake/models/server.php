<?php 

#Note: The template of this code is from http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/

/*
SQLConnector
*/
function UploadConfig($type) {
	

	$openconfig = fopen(__DIR__ . "\..\server_config.txt", 'r');
	$server = '';
	$user = '';
	$pass = '';
	
	while (!feof($openconfig)){
		$lit = fgetc($openconfig);
		if ($lit == '#') {
			fgets($openconfig);
			continue;
		}
		if ($lit == 's') {
			while (fgetc($openconfig) != "'"){
				fgetc($openconfig);
			}
			$u = NULL;
			do {
			$u = fgetc($openconfig);
			if ($u != "'")
				$server .= $u;
			} while ($u != "'");
		}
	//finds user name
		if ($lit == 'u') {
			while (fgetc($openconfig) != "'"){
				fgetc($openconfig);
			}
			$u = NULL;
			do {
				$u = fgetc($openconfig);
				if ($u != "'")
					$user .= $u;
			} while ($u != "'");
		}
	//finds password
		if ($lit == 'p') {
		while (fgetc($openconfig) != "'"){
			fgetc($openconfig);
		}
		$u = NULL;
		do {
		$u = fgetc($openconfig);
		if ($u != "'")
			$pass .= $u;
			} while ($u != "'");
		}
	}
	fclose($openconfig);
	if ($type == "server") {
		return $server;
	} else if ($type == "user") {
		return $user;
	} else if ($type == "pass") {
		return $pass;
	}		
}


class Server {

	#variable declarations
	private static $instance = NULL;
	private $connection = NULL;
	private static $server = NULL;
	private static $user = NULL;
	private static $pass = NULL;
	private static $errors = NULL;
	
	#Establish connection. Constructor private for a singleton structure. The user info is stored in a seperate server_config.txt file
	private function __construct($server, $user, $pass) {
		
		
		mysqli_report(MYSQLI_REPORT_STRICT);

		try {
			$this->connection = new mysqli($server, $user, $pass);
		} catch (Exception $e ) {
			self::$errors = $e->getMessage();
			
			//this makes the page redirect to the start with an error message upon connection failure
			exit('
				<form id = "errormsg" action = "?error=true" method = "POST">
					<input type = hidden name = "servername" value = "'. $server . '">
					<input type = hidden name = "username" value = "' . $user . '">
					<input type = hidden name = "password" value = "'. $pass . '">
					<input type = hidden name = "errors" value =  "'. self::$errors . '"> 
					<input type = "submit" style="display: none;">
				</form>
				<script>
					document.forms["errormsg"].submit();
				</script>'
				);
		}
		self::$errors = NULL;
	}
	private function clone() {}
	
	
	//use this to call up an instance. Note: All variables pointing to the object will point to the same instance
	public static function getInstance() {
		
		#connection procedure
		if (!isset(self::$instance)) {
			self::$server = UploadConfig("server");
			self::$user = UploadConfig("user");
			self::$pass = UploadConfig("pass");
			self::$instance = new Server(self::$server, self::$user, self::$pass);
		} else {
			if ((self::$server != UploadConfig("server")) or (self::$user != UploadConfig("user")) or (self::$pass != UploadConfig("pass"))){
				self::$server = UploadConfig("server");
			self::$user = UploadConfig("user");
			self::$pass = UploadConfig("pass");
				self::$instance = new Server(self::$server, self::$user, self::$pass);
			}
		}
		return self::$instance;
	}
	
	//test returns true if the server connects to a specific and an error message if it doesn't. 
	//Theoretically it will not mess up the instance already stored
	public static function testServer($server, $user, $pass) {
		
		$instance = self::$instance;
		self::$instance = new Server($server, $user, $pass);
		if (isset(self::$instance)){
			self::$instance = $instance;
			return true;
		} else {
			$e = self::$error;
			self::$instance = $instance;
			return $e;
		}
	}
	
	//NOTE: this is a NOT a class function
	public function getQuery($q) {
		$que = $this->connection->query($q);
		if ($que == false) {
			#echo "Error: ". $this->connection->error; //use this when debugging
			return false;
		} else {
			return $que;
		}
	}
}



#testing

$handlerInstance = Server::getInstance();

?>