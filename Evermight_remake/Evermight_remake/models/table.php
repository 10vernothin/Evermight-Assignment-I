<?php

//this class fetches, creates and manipulates a table from a database

class Table {
	
	private $column_names = NULL;
	private $entries = NULL;
	private $primary_keys = NULL;
	private $tablename = NULL;
	private $dbname = NULL;
	
	//column_names wil be in the format of column_names['col_1', ...]
	//entries will be in the format entries['['primary key' => ['col_1', ...]]
	
	private function __construct() {}
	
	//use this function to fetch and create a table object from a database
	//will return FALSE if unable to fetch table
	public static function fetchTable($server, $dbname, $tablename) {

		//variable definitions
		$newtable = new Table();
		$newtable->column_names = array();
		$newtable->entries = array();
		$newtable->primary_keys = array();
		
		//query strings
		$usedb = "use $dbname";
		$extract_columns = "select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where table_name = N'$tablename'";
		$extract_pk = "select COLUMN_NAME from INFORMATION_SCHEMA.KEY_COLUMN_USAGE where table_name = N'$tablename'
								and CONSTRAINT_NAME='PRIMARY'";
		$extract_entries = "Select * from $tablename";
		
		//result set
		$keyresults = $server->getQuery($extract_columns);
		$PK_results = $server->getQuery($extract_pk);
		$server->getQuery($usedb);
		$entry_results = $server->getQuery($extract_entries);
		
		//error-control
		if (($keyresults == false) or ($PK_results == false) or ($entry_results == false)){
			return false;
		}
		
		//populate the column_names
		do {
			$column = $keyresults->fetch_array();
			array_push($newtable->column_names, $column[0]);
		} while (isset($column));
		
		
		
		//unfortunately I still don't know how to do 2-key maps
		$PK = $PK_results->fetch_array()[0];
		$PKEntries = "select $PK from $tablename";
		$row = $entry_results->fetch_array();
		$keys = $server->getQuery($PKEntries);
		$key = $keys->fetch_array();
		do {
			$newtable->entries[$key[0]] = $row;
			if ($key[0]) {
				array_push($newtable->primary_keys, $key[0]);
			}
			$key = $keys->fetch_array();
			$row = $entry_results->fetch_array();
		} while (isset($key[0]));
		
		//defining the rest of the attributes
		$newtable->tablename = $tablename;
		$newtable->dbname = $dbname;
		
		return $newtable;
	}
	
	//I can make an archetypal table, but it just seems a very tedious, what with all the and the fact there may be more than one
	//primary key. So I just made this create_table just so the table can be created and object be fetched
	//will return NULL if not created
	public static function createTable($server, $dbname, $createTableQuery, $tablename) {
		$usedb = "use $dbname";
		$createTb = "$createTableQuery";
		$server->getQuery($usedb);
		$tbres = $server->getQuery($createTb);
		if ($tbres == false){
			echo "Table not created";
		} else {
			$table = self::fetchTable($server, $dbname, $tablename);
			if ($tbres == false){
				echo "Invalid table name";
			} else {
				return $table;
			}
		}
	} 
	
	//this returns a new table
	public function insertNewColreturnNewTable($server, $column_name, $datatype, $isnotnull, $default = NULL) {
		if ($isnotnull) {
			$nnq = "NOT NULL";
			if (!isset($default)){
				$default = 0;
			}
		} else {
			$nnq = "";
		}
		$tblname = $this->tablename;
		if (isset($default)){
			$query = "ALTER TABLE $tblname ADD $column_name $datatype $nnq DEFAULT '$default'";
		} else {
			$query = "ALTER TABLE $tblname ADD $column_name $datatype";
		}
		
		//I'm not sure if this will work
		$server->getQuery($query);
		$newTable = self::fetchTable($server, $this->dbname, $this->tablename);
		return $newTable;
		
	}
	
	public function getPKeysArray() {
		return $this->primary_keys; 
	}
	
	public function getTableName() {
		return $this->tablename;
	}
	
	public function getColumnName($i) {
		return $this->column_names[$i];
	}
	
	public function getEntryRow($i) {
		if (isset($this->primary_keys[$i])){
			$col = $this->primary_keys[$i];
		} 
		if (!isset($col)) {
			return false;
		} else {
			return $this->entries[$col];
		}
	}
	
	//this function is especially useful for show-all display purposes
	public function fetchByArrayOrder($keyNo, $columnNo) {
		$keyval = $this->primary_keys[$keyNo];
		$columnval = $this->column_names[$columnNo];
		$val = $this->entries[$keyval][$columnval];
		return $val;
	}
	
	
	
}

/*
testing

$table = Table::fetchTable(Server::getInstance(), "assignmentdatabase", "tbl_automobiles");
echo $table->fetchByArrayOrder(0,0);
*/
?>
