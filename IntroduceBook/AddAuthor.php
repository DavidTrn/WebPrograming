<?php
	session_start();
	include_once 'dbconnect.php';

	$input = (object) json_decode(file_get_contents('php://input'),true);

	$method = $_SERVER['REQUEST_METHOD'];
	switch ($method) {
	  	case 'GET':
	    	break;
	  	case 'PUT':
	    	break;
	  	case 'POST':
	  		$aname = $MySQLi_CON->real_escape_string(trim($input->aname));
			$aintro = $MySQLi_CON->real_escape_string(trim($input->aintro));
				
			$query = "INSERT INTO authors(AUTHOR_NAME, INTRODUCE) VALUES('$aname', '$aintro')";

			if($MySQLi_CON->query($query))
			{
				$obj = [];
				$obj['status'] = 1;
				echo json_encode($obj);
				
			}
			else
			{
				$obj = [];
				$obj['status'] = 0;
				echo json_encode($obj);
			
			}
			
			$MySQLi_CON->close();

	    	break;
	  	case 'DELETE':
	    	break;
	}

?>