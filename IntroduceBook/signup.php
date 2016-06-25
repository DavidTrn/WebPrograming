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
	  		$uname = $MySQLi_CON->real_escape_string(trim($input->uname));
		    $email = $MySQLi_CON->real_escape_string(trim($input->uemail));
		    $fname = $MySQLi_CON->real_escape_string(trim($input->ufname));
		    $lname = $MySQLi_CON->real_escape_string(trim($input->ulname));
			$pass  = $MySQLi_CON->real_escape_string(trim($input->upass));
			$gen   = $MySQLi_CON->real_escape_string(trim($input->ugen));

			$new_pass = password_hash($pass, PASSWORD_DEFAULT);

			$check_email = $MySQLi_CON->query("SELECT EMAIL FROM users WHERE EMAIL='$email' OR USERNAME='$uname'");
			$count=$check_email->num_rows;
		
			if($count == 0){
				
				$query = "INSERT INTO users(USERNAME,EMAIL,PASSWORD,FIRSTNAME,LASTNAME,GENDER) VALUES('$uname','$email','$new_pass','$fname','$lname','$gen')";

				if($MySQLi_CON->query($query))
				{
					$obj = [];
					$obj['status'] = 1;
					echo json_encode($obj);
					// $msg = "<div class='alert alert-success'>
					// 			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
					// 		</div>";
				}
				else
				{
					$obj = [];
					$obj['status'] = 0;
					echo json_encode($obj);
					// $msg = "<div class='alert alert-danger'>
					// 			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
					// 		</div>";
				}
			}
			else{
				$obj = [];
				$obj['status'] = 2;
				echo json_encode($obj);
				// $msg = "<div class='alert alert-danger'>
				// 			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry email already taken !
				// 		</div>";
					
			}
			
			$MySQLi_CON->close();

	    	break;
	  	case 'DELETE':
	    	break;
	}

?>