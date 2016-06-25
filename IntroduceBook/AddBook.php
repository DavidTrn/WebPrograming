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
	  		$bname = $MySQLi_CON->real_escape_string(trim($input->bname));
		    $bpublisher = $MySQLi_CON->real_escape_string(trim($input->bpublisher));
		    $bdistributor = $MySQLi_CON->real_escape_string(trim($input->bdistributor));
		    $bsell = $MySQLi_CON->real_escape_string(trim($input->bsell));
		    $bcategory = $MySQLi_CON->real_escape_string(trim($input->bcategory));
			$bimg = $MySQLi_CON->real_escape_string(trim($input->bimg));
			$bdis = $MySQLi_CON->real_escape_string(trim($input->bdis));
				
			$query = "INSERT INTO books(BOOK_NAME,PUBLISHER,DISTRIBUTOR,CATEGORY_CODE,SELL_AT,IMAGE, DISCRIPTION) VALUES('$bname','$bpublisher','$bdistributor','$bcategory','$bsell','$bimg', '$bdis')";

			if($MySQLi_CON->query($query))
			{
				$query = $MySQLi_CON->query("SELECT AUTHOR_NAME FROM authors WHERE AUTHOR_NAME='$bpublisher'");
				$count=$query->num_rows;
				if ($count == 0) {
					$query = $MySQLi_CON->query("INSERT INTO authors(AUTHOR_NAME) VALUES('$bpublisher')");
				}
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