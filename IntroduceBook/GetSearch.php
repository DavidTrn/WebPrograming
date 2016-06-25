<?php
	include('dbconnect.php');
?>

<?php
if(isset($_POST['res'])) {
	$result= $_POST['res'];
	$sql = $MySQLi_CON->query ("SELECT * FROM books WHERE BOOK_NAME COLLATE UTF8_GENERAL_CI LIKE '$result%'");
	$outp = array();
	while($output = $sql->fetch_array()) {
		//echo '<a class="form-control">'.$output['BOOK_NAME'].'</a>';
		$outp[] = array("Name" => $output['BOOK_NAME'],"Link" => $output['BOOK_ID']);
	}
	echo json_encode($outp);
}


if(isset($_POST['search'])) {
	$book = $_POST['data'];
	$i = $_POST['page']*10-10;
	$j=0;
	$size = 0;
	$sql = $MySQLi_CON->query( "SELECT BOOK_ID FROM books WHERE BOOK_NAME COLLATE UTF8_GENERAL_CI like '$book%'");
	while ($row = $sql->fetch_array()) $size++;
	$outp = array();
	$sql = $MySQLi_CON->query( "SELECT * FROM books WHERE BOOK_NAME COLLATE UTF8_GENERAL_CI like '$book%'");
	while ($row = mysqli_fetch_array($sql)) { 
		if($j>=$i && $j<$i+10) {
		$author = $MySQLi_CON->query("SELECT * FROM authors WHERE AUTHOR_ID = '".$row['AUTHOR_ID']."'");
		while($authorid = $author->fetch_array())
		$outp[] = array("Size"=>$size,"Name" => $row['BOOK_NAME'],"Id" => $row['BOOK_ID'],"Img" => $row['IMAGE'],"Aut" => $authorid['AUTHOR_NAME'],"Trans" => $row['TRANSLATOR'],"Pub" => $row['PUBLISHER'],"Dis" => $row['DISTRIBUTOR'], "Des" => $row['DISCRIPTION']);
	}
	$j++;
}
		echo json_encode($outp);
			

}


if(isset($_POST['getTop'])) {
	$sql = $MySQLi_CON->query( "SELECT * FROM books ORDER BY RATE_ID DESC LIMIT 5");
	$outp = array();
	while ($row = mysqli_fetch_array($sql)) { 
		$author = $MySQLi_CON->query("SELECT * FROM authors WHERE AUTHOR_ID = '".$row['AUTHOR_ID']."'");
		while($authorid = $author->fetch_array())
		$outp[] = array("Name" => $row['BOOK_NAME'],"Link" => $row['LINK'],"Img" => $row['IMAGE'],"Aut" => $authorid['AUTHOR_NAME'],"Trans" => $row['TRANSLATOR'],"Pub" => $row['PUBLISHER'],"Dis" => $row['DISTRIBUTOR']);
	}
		echo json_encode($outp);
			

}
		

		$MySQLi_CON->close();
?>