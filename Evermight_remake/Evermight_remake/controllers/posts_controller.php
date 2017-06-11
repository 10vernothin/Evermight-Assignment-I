<?php 

#Note: The template of this code is from http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/

/*
	This is a model
*/

class PostsController {
	
	

	//this function gets all the values of the and shows it in a table
	public function showAll() {
		$server = Server::getInstance();
		$dbname = "assignmentdatabase";
		$tablename = "tbl_automobiles";
		$create_table_query = "CREATE TABLE tbl_automobiles (
						automobile_id 		INT 	NOT NULL	 AUTO_INCREMENT,
						car_model 			VARCHAR (50),
						weight 				DECIMAL (10, 2),
						manufacture_year	YEAR,
							PRIMARY KEY (automobile_id)
					)";
			
		$table = Table::fetchTable($server, $dbname, $tablename);
		$email_query = true;
		$it = 0;
		$colval = array();
		
		while ($it < 5) {
			if ($table == false) {	
				if (isset($create_table_query)){
					$table = Table::createTable($server, $dbname, $create_table_query, $tablename);
					$create_table_query = NULL;
					continue;
				} else {
					redir("?", "Something went wrong.");
				}
			} else {
				if (isset($email_query)){
					$table = $table->insertNewColreturnNewTable($server, "sales_email", "varchar (50)", true, "@hotmail.com");
					$email_query = NULL;
					continue;
				}				
				//this is for backwards compatibility
				$a= 0;
				$col = $table->getColumnName($a);
				while (isset($col)){
					if (isset($_POST[$col])) {
						$colval[$a] = $_POST[$col];
					} else {
						$colval[$a] = "";
					}
					$a++;
					$col = $table->getColumnName($a);
				}
				$it = 5;
				require_once('views/pages/tbl-automobiles.php');
			}
		}
	}
	
	//validate does not need much because it's generalized
	public function validate() {
		$server = Server::getInstance();
		$dbname = "assignmentdatabase";
		$tablename = "tbl_automobiles";
		
		$table = Table::fetchTable($server, $dbname, $tablename);
		
		if ($table == false) {
			echo "Table not found.";
		} else {
			require_once('models/validate.php');
		}
	}
	
	public function edit() {
		
		//variable declaration
		$server = Server::getInstance();
		$dbname = "assignmentdatabase";
		$tablename = "tbl_automobiles";
		$PKname = NULL;
		$idkeyNo = NULL; 
		$idkeyVal = NULL;
		$table = Table::fetchTable($server, $dbname, $tablename);
		
		if ($table == false) {
			echo "Table not found.";
		} else {
			
			//This finds the primary key name, the position of the idkey and value and imports them
			$PKname = $table->getColumnName(0);
			if (!isset($_POST[$PKname])){
				$_POST[$PKname] = "";
				$idkeyNo = "";
				$idkeyVal = "";
			} else {
				$idkeyNo = array_search($_POST[$PKname], $table->getPKeysArray());
				$idkeyVal = $_POST[$PKname];
			}

			require_once('views/pages/automobile-edit.php');
		}
	}
	
}


#testing


?>