<?php

	$DB_host = "localhost";
	$DB_user = "root";
	$DB_pass = "";
	$DB_name = "book_intro";
	 
	$MySQLi_CON = new MySQLi($DB_host,$DB_user,$DB_pass,$DB_name);
    
    if($MySQLi_CON->connect_errno)
    {
        die("ERROR : -> ".$MySQLi_CON->connect_error);
    }

    // Change character set to utf8
	mysqli_set_charset($MySQLi_CON,"utf8");

?>