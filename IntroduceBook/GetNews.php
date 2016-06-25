<?php
	include('dbconnect.php');
?>

<?php
if(isset($_POST['getNews'])) {
	$i = $_GET['page']*10-10;
	$j=0;
	$size = 0;
	$sql = $MySQLi_CON->query( "SELECT NEWS_ID FROM news");
	while ($row = $sql->fetch_array()) $size++;
	$sql = $MySQLi_CON->query( "SELECT * FROM news ORDER BY CREATED_AT DESC");
	$outp = array();
	while ($row = mysqli_fetch_array($sql)) {
		if($j>=$i && $j<$i+10) {
		$outp[] = array("Size" => $size, "Title" => $row['TITLE'],"ID" => $row['NEWS_ID'],"Img" => $row['IMAGE_NEWS'],"Desc" => $row['DESCRIPTION']);
		}
		$j++;
}
		echo json_encode($outp);
			

}

if(isset($_GET['getNewsDetail'])) {
	$sql = $MySQLi_CON->query( "SELECT * FROM news WHERE NEWS_ID='".$_GET['id']."'");
	$row = mysqli_fetch_object($sql);
	header("Content-type: text/x-json");
	echo json_encode($row);
			
}

if(isset($_POST['getMoreNews'])) {
	$sql = $MySQLi_CON->query( "SELECT NEWS_ID,TITLE FROM news ORDER BY CREATED_AT DESC LIMIT 4");
	$outp = array();
	while ($row = mysqli_fetch_array($sql)) 
	$outp[] = array("Title" => $row['TITLE'],"ID" => $row['NEWS_ID']);

	echo json_encode($outp);
			
}
$MySQLi_CON->close();
?>