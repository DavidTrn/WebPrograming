<?php
	session_start();
	include("dbconnect.php");


	$input = (object) json_decode(file_get_contents('php://input'),true);

	$method = $_SERVER['REQUEST_METHOD'];
	switch ($method) {
	  	case 'GET':
	    	break;
	  	case 'PUT':
	    	break;
	  	case 'POST':
	  		$aid = $MySQLi_CON->real_escape_string(trim($input->aid));
	  		$aname = $MySQLi_CON->real_escape_string(trim($input->aname));
			$aintro = $MySQLi_CON->real_escape_string(trim($input->aintro));

			$query = "UPDATE authors SET AUTHOR_NAME='$aname', INTRODUCE='$aintro' WHERE AUTHOR_ID='$aid'";

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