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
	  		$bid = $MySQLi_CON->real_escape_string(trim($input->bid));
	  		$bname = $MySQLi_CON->real_escape_string(trim($input->bname));
		    $bpublisher = $MySQLi_CON->real_escape_string(trim($input->bpublisher));
		    $bdistributor = $MySQLi_CON->real_escape_string(trim($input->bdistributor));
		    $bsell = $MySQLi_CON->real_escape_string(trim($input->bsell));
		    $bcategory = $MySQLi_CON->real_escape_string(trim($input->bcategory));
			$bimg = $MySQLi_CON->real_escape_string(trim($input->bimg));
			$bdis = $MySQLi_CON->real_escape_string(trim($input->bdis));

			$query = "UPDATE books SET BOOK_NAME='$bname', PUBLISHER='$bpublisher', DISTRIBUTOR='$bdistributor', CATEGORY_CODE='$bcategory', SELL_AT='$bsell', IMAGE='$bimg', DISCRIPTION='$bdis' WHERE BOOK_ID='$bid'";

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