
<?php
	session_start();

	include_once 'dbconnect.php';
	
	$urlimage = $_REQUEST["urlimage"];
	$sql = "UPDATE users SET AVATAR='$urlimage' WHERE USER_ID=".$_SESSION["userSession"];
	$result = mysqli_query($MySQLi_CON,$sql) or die("Could not insert.");

	$MySQLi_CON->close();	
?>
