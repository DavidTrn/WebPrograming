<?php
	include('dbconnect.php');

	if(isset($_GET['bookType'],$_GET['page'])) {
		$i = $_GET['page']*12-12;
		$j=0;
		$size = 0;
		$sql = $MySQLi_CON->query("SELECT * FROM books WHERE CATEGORY_CODE = '".$_GET['bookType']."'");
		$outp = array();
		while ($row = $sql->fetch_array()) $size++;
		$sql = $MySQLi_CON->query("SELECT * FROM books WHERE CATEGORY_CODE = '".$_GET['bookType']."'");
		while ($row = $sql->fetch_array()) {

			if($j>=$i && $j<$i+12) {
			$author = $MySQLi_CON->query("SELECT * FROM authors WHERE AUTHOR_ID = '".$row['AUTHOR_ID']."'");
			while($authorid = $author->fetch_array())
			$outp[] = array("Size" => $size, "Name" => $row['BOOK_NAME'],"Id" => $row['BOOK_ID'],"Img" => $row['IMAGE'],"Aut" => 
				$authorid['AUTHOR_NAME'],"Trans" => $row['TRANSLATOR'],"Pub" => $row['PUBLISHER'],"Dis" => $row['DISTRIBUTOR'],"Category" => $row['CATEGORY_NAME']);
			}
			$j++;
		} 
		echo json_encode($outp);		

	}

	$MySQLi_CON->close();
//select them mot bang de trong vong while, 
	//SELECT * FROM table1 ORDER BY id LIMIT 5
?>
