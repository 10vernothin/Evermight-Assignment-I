<?php 
	//redir.php is a set of functions that helps redirect the pages
	require_once("models/redir.php");
	require_once('models/server.php');
	
	//control structure
	if (isset($_GET['controller']) and isset($_GET['action'])) {
		$controller = $_GET['controller'];
		$action     = $_GET['action'];
	} else {
		//default page
		$controller = 'pages';
		$action     = 'start';
	}
	
	require_once('routes.php');
?>
