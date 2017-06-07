<?php 

#Note: Some snippets are taken from W3Schools.com

/*
SQLHandler is an object that can be instantiated. It uses MySQLI to connect and interact with MySQL Database. 
Unfortunately I don't know how to use PDO without specifying the name of the database.
*/

class SQLHandler {

	#variables calls
	
	private $username;
	private $servername;
	private $password;
	private $connect;
	
	
	#Establish connection upon object instantiation
	public function __construct($server = "localhost3306", $user = "root", $pass = "") {
		
		#BEFORE EXECUTING, PLEASE EDIT THESE FOR YOUR OWN DATABASE. DEFAULT IS MY OWN
		$this->username = $user;
		$this->servername =  $server;
		$this->password =  $pass;
		
		#connection procedure
		
		$this->connect = new mysqli($this->servername, $this->username, $this->password);
		if ($this->connect->connect_error) {
				exit("Connection failed: " . $this->connect->connect_error);
		}
		#echo "Connected successfully. ";
	}
	
	#public methods
	
	#this function inputs a string $name and creates a database with the string as its name in $connect. $isEphemeral is for
	#testing purposes, and if true, the database will be created, logged and deleted instead
	public function createDatabase($name, $isEphemeral) {
		if ($this->connect->query("CREATE DATABASE $name") === TRUE) {
			#echo "Database $name created successfully. ";
			if ($isEphemeral) {
				if ($this->connect->query("DROP DATABASE $name") === TRUE) {
					#echo "Database $name deleted successfully .";
				} else {
					#echo "Error deleting database: " . $this->connect->error;
				}
			}
		} else {
			#echo "Error creating database: " . $this->connect->error;
		}
		return $this;
	}
	
	#this function selects the database with dbname if able
	public function selectDatabase($dbname) {
		if ($this->connect->query("USE $dbname") === TRUE) {
			#echo "Database $dbname Selected. ";
		} else {
			#echo "Error: " . $this->connect->error;
		}
		return $this;
	}
	
	#this all-purpose function allows you to insert any type of queries and execute them
	public function insertQuery($query) {
		if ($this->connect->query("$query") === TRUE) {
			#echo "Query completed. ";
		} else {
			#echo "Error completing query: " . $this->connect->error;
		}
		return $this;
	}
	
	#this function is insertQuery but it returns the $result object
	public function insertQueryReturnResult($query) {
		$q = $this->connect->query("$query");
		if ($q === TRUE) {
			#echo "Query completed. ";
		} else {
			#echo "Error completing query: " . $this->connect->error;
		}
		return $q;
	}
	
	#this destroys the database with the name if able
	public function dropDatabase($name) {
		if ($this->connect->query("DROP DATABASE $name") === TRUE) {
			#echo "Database deleted. ";
		} else {
			#echo "Error deleting database: " . $this->connect->error;
		}
		return $this;
	}
	
	#change configuration
	public static function ConfigUser($newuser) {
		self::$defusername = $newuser;
	}
	public static function ConfigServer($newserver) {
		self::$defservername = $newserver;
	}
	public static function ConfigPassword($newpass) {
		self::$defpassword = $newpass;
	}
	
}

/*
#testing

echo "TESTING. ";


$handlerInstance = new SQLHandler();

$handlerInstance->createDatabase("AUTO", 0);
$handlerInstance->selectDatabase("AUTO");
$createTable = "CREATE TABLE CARS (
   ID INT NOT NULL AUTO_INCREMENT,
   NAME VARCHAR (20) NOT NULL,
   TYPE VARCHAR (20) NOT NULL,
   PRICE DECIMAL (18, 2) NOT NULL,       
   PRIMARY KEY (ID))";
$handlerInstance->insertQuery($createTable);

$handlerInstance->dropDatabase("AUTO");
*/
?>