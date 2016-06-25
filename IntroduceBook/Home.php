<?php
	include("login.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Home</title>

    <meta name="author" content="3D1A Team!">

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">  

</head>
<body>

<?php
	include('modal.php');
?>

<div class="container-fluid">

	<!-- insert header and slider -->
	<?php
		include('header.php');
		include('slider.php');
	?>

	<div class="my-body-container">
		<div class="row">
			<div class="col-md-12 my-title-categories">
				<h2 class="my-title-categories-h2">Sách nổi bật</h2>
			</div>
		</div>
		<div class="row underline-title">
			<div class="col-md-12 no-pad-mar-underline-title">
				<div class="underline-decoration"></div>
			</div>
			
		</div>
		<div class="row">

			<?php
				include('dbconnect.php');

				$query = $MySQLi_CON->query("SELECT * FROM books");
				$count = $query->num_rows;

				//fetch the data from the database
				if ($count != 0) {
					$numbook = 0;
					while ($row = $query->fetch_array()) {
						if (strpos($row['TYPE'],'Highlight') !== false) {
							$numbook++;
							if ($numbook <= 6) {
								echo '<div class="col-md-2 col-xs-6 col-sm-4 item-center">
										<a href="DetailBook.php?book_id='.$row['BOOK_ID'].'">
											<img class="my-item" src="'.$row['IMAGE'].'" alt="image"/>
											<span  class="showimage"><img src="'.$row['IMAGE'].'" alt="image"/></span>
										</a>
										<h4>'.$row['BOOK_NAME'].'</h4>
									</div>';
							}
						}
					}
				}

				$MySQLi_CON->close();

			?>

		</div>
		<div class="row">
			<div class="col-md-12 my-title-categories">
				<h2 class="my-title-categories-h2">Sách mới phát hành</h2>
			</div>
		</div>
		<div class="row underline-title">
			<div class="col-md-12 no-pad-mar-underline-title">
				<div class="underline-decoration"></div>
			</div>
			
		</div>
		<div class="row">

			<?php
				include('dbconnect.php');

				$query = $MySQLi_CON->query("SELECT * FROM books");
				$count = $query->num_rows;

				//fetch the data from the database
				if ($count != 0) {
					$numbook = 0;
					while ($row = $query->fetch_array()) {
						if (strpos($row['TYPE'],'New') !== false) {
							$numbook++;
							if ($numbook <= 6) {
								echo '<div class="col-md-2 col-xs-6 col-sm-4 item-center">
										<a href="DetailBook.php?book_id='.$row['BOOK_ID'].'">
											<img class="my-item" src="'.$row['IMAGE'].'" alt="image"/>
											<span  class="showimage"><img src="'.$row['IMAGE'].'" alt="image"/></span>
										</a>
										<h4>'.$row['BOOK_NAME'].'</h4>
									</div>';
							}
						}
					}
				}

				$MySQLi_CON->close();

			?>

		</div>
		<div class="row">
			<div class="col-md-12 my-title-categories">
				<h2 class="my-title-categories-h2">Sách được tìm nhiều</h2>
			</div>
		</div>
		<div class="row underline-title">
			<div class="col-md-12 no-pad-mar-underline-title">
				<div class="underline-decoration"></div>
			</div>
			
		</div>
		<div class="row">

			<?php
				include('dbconnect.php');

				$query = $MySQLi_CON->query("SELECT * FROM books");
				$count = $query->num_rows;

				//fetch the data from the database
				if ($count != 0) {
					$numbook = 0;
					while ($row = $query->fetch_array()) {
						if (strpos($row['TYPE'],"Most-search") !== false) {
							$numbook++;
							if ($numbook <= 6) {
								echo '<div class="col-md-2 col-xs-6 col-sm-4 item-center">
										<a href="DetailBook.php?book_id='.$row['BOOK_ID'].'">
											<img class="my-item" src="'.$row['IMAGE'].'" alt="image"/>
											<span  class="showimage"><img src="'.$row['IMAGE'].'" alt="image"/></span>
										</a>
										<h4>'.$row['BOOK_NAME'].'</h4>
									</div>';
							}
						}
					}
				}

				$MySQLi_CON->close();

			?>

		</div>
	</div>
</div>

<?php
	include('footer.php');
?>

<script src="js/modal-scripts.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
<script>
	$(document).ready(function(){
		$("#whatsearch").keyup(function() {
			$("#livesearch").show();	
			var x= $(this).val();
			if(x=="") $("#livesearch").hide();
			$.ajax({
				url: "GetSearch.php",
				type: "POST",
				dataType: "json",
				data: 'res='+x,
				success:function(data) {
						liveSearch(data);

				}
			});
		});
	});


	function liveSearch(response) {
    var i,j;
    var out="";
    for(i = 0; i < response.length; i++) {
    
    	out +='<a class="form-control" href="DetailBook.php?book_id=' +response[i].Link+ '">' +response[i].Name+'</a>' ;
    	}
    	document.getElementById("livesearch").innerHTML =out;
	    out=""; 
	}
</script>
</body>
</html>