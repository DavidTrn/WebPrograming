<?php
	include("login.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Categories</title>

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
	<?php
		include('header.php');
	?>
	
	<!-- Cover Loại Sách -->
	<div class="row">
		<div class="col-md-12 custom-slider">
			<img src="assets/<?php if (isset($_GET['Category'])) {
			if($_GET['Category']=="KinhTe") echo "doanhnhan-1301-1170x260.jpg";
			else if($_GET['Category']=="VanHocNuocNgoai") echo "bestseller.jpg";
			else if($_GET['Category']=="VanHocTrongNuoc") echo "Giamgiasach.jpg";
			else echo "library4.jpg"; }?>" alt="Thể Loại Sách" style="width:100%">	
		</div>
	</div>

	<!-- Body content -->
	<div class="my-body-container">
		<div class="row">
			<div class="col-md-12 my-title-categories">
				<h2 class="my-title-categories-h2" id="title"></h2>

			</div>
		</div>
		<div class="row underline-title">
			<div class="col-md-12 no-pad-mar-underline-title">
				<div class="underline-decoration"></div>
			</div>
			
		</div>
		<div id="showbook">
		</div>
		<div class="row">
			<div style="text-align:center;display: block;margin:0 auto">
				<ul class="pagination" id="page">
	  			</ul>
  			</div>
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
		showData();	
		$("#whatsearch").keyup(function() {
			$("#livesearch").show();	
			var x= $(this).val();
			if(x=="") $("#livesearch").hide();  /*show va hide dung de hien va giau thong tin*/
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
	function showData() {
		$.ajax({
			url: "GetCategory.php?bookType=<?php if (isset($_GET['page'],$_GET['Category'])) echo $_GET['Category']."&page=".$_GET['page'];?>",
			type: "get",
			dataType: "json",
			async:false,
			success:function(r) {
				myFunction(r);
			}

		});

	}

	function myFunction(response) {
    var i,j,index;
    var out="";
     var page="";
    for(i=0;i<response[0].Size/12; i++) {
    	j=i+1;
    index = <?php if (isset($_GET['page']))  echo $_GET['page']?>;
    if(index==j)
    page += '<li class="active"><a href="BookCategories.php?Category=<?php if (isset($_GET['page'],$_GET['Category'])) echo $_GET['Category']."&page='+j+'"; ?>">'+j+'</a></li>' ;
	else page += '<li><a href="BookCategories.php?Category=<?php if (isset($_GET['page'],$_GET['Category'])) echo $_GET['Category']."&page='+j+'"; ?>">'+j+'</a></li>' ;
    	}
    document.getElementById("page").innerHTML=page;
    page="";
    for(i = 0; i < response.length; i++) {
    	j=i+1; 	
  	 	if(i==0 || i==6)
  	 	out+='<div class="row">';
  	 	out+='<div class="col-md-2 col-xs-12 col-sm-4 item-center"><div class="wrap-info">';
    	out +='<a href="DetailBook.php?book_id='+response[i].Id+'">';
        out += "<img class=\"my-item book\" src=\""+ response[i].Img+"\" title=\""+response[i].Name+"\" alt=\"abc\">";
        out += "<div class=\"info\">";
        out += "<p><i>Tác giả</i>: "+response[i].Aut+"<br>";
        if(response[i].Trans!=null)	out += "<i>Người dịch</i> : "+response[i].Trans+"<br>";
        out += "<i>Nhà xuất bản</i> : "+response[i].Pub+"<br>";
        out += "<i>Nhà phát hành</i> : "+response[i].Dis+"<br>";
        out += "</div></a></div>";
        out += '<a href="DetailBook.php?book_id='+response[i].Id+'"><h4>'+response[i].Name+'</h4></div>';
        if(i==5 || i==11)
        out+='</div>';
    	}
    	document.getElementById("showbook").innerHTML=out;
    	document.getElementById("title").innerHTML=response[0].Category;
	    out=""; 
	}

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