<?php
	include("dbconnect.php");

	$deleteStatus = "";

	if (isset($_GET['lstDel'])){

		$arrUserID = explode(",",$_GET['lstDel']);	
			
		$sql = 'DELETE FROM users WHERE USER_ID IN ('.$_GET['lstDel'].')';
		$retval = $MySQLi_CON->query($sql);
		// $retval = mysqli_query( $dbhandle, $sql );
		if(!$retval )
		{
		  die('Could not delete data: ' . mysqli_error());
		}
		else {
			$deleteStatus = "Delete successfully!";
			for ($i=0; $i<count($arrUserID); $i++) {
				$uid = (int)$arrUserID[$i];
				$query = $MySQLi_CON->query("SELECT COMMENT_ID FROM comments WHERE USER_ID='$uid'");
				$count=$query->num_rows;
				if ($count != 0) {
					while ($row = $query->fetch_array()) {
						$sql = "DELETE FROM comments WHERE COMMENT_ID=".$row['COMMENT_ID'];
						$retval = $MySQLi_CON->query($sql);
					}
				}
			}

		}			
		
	}

	include('UserList.php');

	//close the connection
	$MySQLi_CON->close();

?>