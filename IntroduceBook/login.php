<?php
	session_start();

	include_once 'dbconnect.php';

	if (!isset($_COOKIE['guestid'])){
		setCookie('guestid',session_id(),0,"/");
		if (isset($_COOKIE['userid'])){
			$query = $MySQLi_CON->query("SELECT * FROM users WHERE USER_ID=".$_COOKIE['userid']);
	    	$row=$query->fetch_array();
	    	if ($row['SIGNED_IN'] == true){
	    		$_SESSION['userSession'] = $_COOKIE['userid'];
	    	}
	    	else {
	    		$_SESSION['userSession'] = "";
	    	}
		}
		else {
			$_SESSION['userSession']="";
		}
	}
	else {
		
		if($_SESSION['userSession']!="")
		{
			$query = $MySQLi_CON->query("SELECT * FROM users WHERE USER_ID=".$_SESSION['userSession']);
		    $row=$query->fetch_array();
		    $MySQLi_CON->close();
		}

		else {
			$input = (object) json_decode(file_get_contents('php://input'),true);
			if (isset($input->ulogin) && isset($input->upass) && isset($input->remember)) {
				$method = $_SERVER['REQUEST_METHOD'];
				switch ($method) {
				  	case 'GET':
				    	break;
				  	case 'PUT':
				    	break;
				  	case 'POST':
					    $login = $MySQLi_CON->real_escape_string(trim($input->ulogin));
						$pass = $MySQLi_CON->real_escape_string(trim($input->upass));
						$remember = $input->remember;

						$query = $MySQLi_CON->query("SELECT USER_ID, USERNAME, EMAIL, PASSWORD FROM users WHERE EMAIL='$login' OR USERNAME='$login'");

						$row=$query->fetch_array();
						// if ($pass === $row['PASSWORD'])
						// {
						if(password_verify($pass, $row['PASSWORD']))
						{
							$_SESSION['userSession'] = $row['USER_ID'];
							// $_SESSION['username'] = $row['USERNAME'];
							$output = [];
							$output['status'] = 1;
							$output['username'] = $row['USERNAME'];

							if ($remember == true) {//==========
								$query = $MySQLi_CON->query("UPDATE users SET SIGNED_IN=true WHERE USER_ID=".$row['USER_ID']);
							}
							else {
								$query = $MySQLi_CON->query("UPDATE users SET SIGNED_IN=false WHERE USER_ID=".$row['USER_ID']);
							}
							setCookie('userid',$row['USER_ID'],time() + (86400 * 30),"/");
							echo json_encode($output);
							
						}
						else
						{
							$output = [];
							$output['status'] = 0;
							$output['username'] = "";
							echo json_encode($output);
						}
						
						$MySQLi_CON->close();

				    	break;
				  	case 'DELETE':
				    	break;
			    }	
			}
		}

	}
	
?>