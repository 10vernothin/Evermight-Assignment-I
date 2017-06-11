<?php
  //define call
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      
	  case 'pages':
        $controller = new PagesController();
      break;
	  
      case 'posts':
        // we need the model to query the database later in the controller
        require_once('models/table.php');
        $controller = new PostsController();
      break;
	  
	  case 'server':
		//this is for server connection and server update
		require_once('models/server.php');
		$controller = new ServerController();
	  break;
    }

    $controller->{ $action }();
  }

  // keys for all controllers
  $controllers = array('pages' => ['start', 'error'],
                       'posts' => ['showAll', 'validate', 'edit'],
					   'server' => ['update']);
	
	
  //this is the actual 'active' call function 
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>