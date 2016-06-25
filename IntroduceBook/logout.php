<?php
session_start();

if(!isset($_SESSION['userSession']))
{
	// header("Location: home.php");
	$uaccount = "Tài khoản";
}
else if(isset($_SESSION['userSession'])!="")
{
	header("Location: Home.php");
}

if(isset($_GET['logout']))
{
	include_once 'dbconnect.php';//=============
	$query = $MySQLi_CON->query("UPDATE users SET SIGNED_IN=false WHERE USER_ID=".$_SESSION['userSession']);
	$MySQLi_CON->close();

	
	$_SESSION['userSession']="";
	header("Location: Home.php");
}
?>