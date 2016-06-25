<?php
	include("login.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Search</title>

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
			<img src="assets/theme-sach4.jpg" alt="Sách Tiểu Thuyết" style="width:100%">	
		</div>
	</div>

	<!-- Body content -->
	<div class="my-body-container" >
		<div class="col-md-10 col-xs-12 col-sm-9">
			<div class="row">
				<div class="col-md-12 my-title-categories">
					<!-- <h2 class="section-title text-center wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; padding: 0;margin: 0;">Sách nổi bật</h2> -->
					<h2 class="my-title-categories-h2">Kết Quả Tìm Kiếm</h2>
				</div>
			</div>
			<div class="row underline-title">
				<div class="col-md-12 no-pad-mar-underline-title">
					<div class="underline-decoration"></div>
				</div>		
			</div>
			<div id="showSearch">

			</div>
			<div class="row">
				<div style="text-align:center;display: block;margin:0 auto">
					<ul class="pagination" id="page">
		  			</ul>
	  			</div>
  			</div>
		</div>
		<div class="col-md-2 col-xs-12 col-sm-3">
			<div class="row">
				<div class="col-md-12 my-title-categories">
					<!-- <h2 class="section-title text-center wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; padding: 0;margin: 0;">Sách nổi bật</h2> -->
					<h2 class="my-title-categories-h2">Xem Nhiều</h2>
				</div>
			</div>
			<div class="row underline-title">
				<div class="col-md-12 no-pad-mar-underline-title">
					<div class="underline-decoration"></div>
				</div>		
			</div>
			<div id="top">

			</div>
		</div>
	</div>
</div>


<?php
    include('footer.php');
?>


<?php
if(isset($_POST['search'])) {
	$search = $_POST['whatsearch'];		
		}
else if(isset($_GET['q'])) 
	$search = $_GET['q'];		
		

	?>


<script src="js/modal-scripts.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
<script>
$(document).ready(function(){
	showSearch();
	getTop();	
	$("#whatsearch").keyup(function() {
            $("#livesearch").show();    
            var x= $(this).val();
            $.ajax({
                url: "GetSearch.php",
                type: "POST",
                dataType: "json",
                data: 'res=' + x,
                success:function(data) {
                        liveSearch(data);

                }
            });
        });
    });
	function showSearch() {
		$.ajax({
			url: "GetSearch.php",
			type: "post",
			dataType: "json",
			async:false,
			data: {
				'search' : 1,
				'data' : "<?php echo $search; ?>",
				'page' : "<?php if (isset($_GET['page'])) echo $_GET['page']; ?>"
			},
			success:function(r) {
					myFunction(r);
				
			}

		});

	}

	function getTop() {
		$.ajax({
			url: "GetSearch.php",
			type: "post",
			dataType: "json",
			async:false,
			data: {
				'getTop' : 1,
			},
			success:function(restop) {
					showTop(restop);
				
			}

		});

	}

	function myFunction(response) {
    var i,j;
    var out;
    var space ="";
    var page="";
    for(i=0;i<response[0].Size/10; i++) {
    j=i+1;
	index = <?php if (isset($_GET['page']))  echo $_GET['page']?>;
	    if(index==j)
	    	page += '<li class="active"><a href="TimKiem.php?q=<?php echo $search?>&page='+j+'">'+j+'</a></li>' ;
		else 
			page += '<li><a href="TimKiem.php?q=<?php echo $search?>&page='+j+'">'+j+'</a></li>' ;
    	}
    document.getElementById("page").innerHTML=page;
    page="";
    document.getElementById("showSearch").innerHTML ='<h3>Có ' + response[0].Size + ' kết quả tìm kiếm với: '+ 
     "<?php echo $search; ?>" +'<h3>';
    for(i = 0; i < response.length; i++) {
  	 	out="";
  	 	if(i>0) space = 'style="margin-top:20px"';
  	 	else space ="";

    	out = '<div class="row" '+ space +'>';
        out += '<div class="col-md-3 col-xs-12 col-sm-4 item-center">';
        out += '<a href="DetailBook.php?book_id='+response[i].Id+'">';
        out += '<img class="my-item book" src="'+response[i].Img +'"  title="' +response[i].Name + '" alt="abc">';
        out += '</a></div>';
        out += '<div class="col-md-9 col-xs-12 col-sm-8">';
        out += '<div class="col-md-6 col-xs-12 col-sm-8 ">';
        out += '<a href="DetailBook.php?book_id='+response[i].Id+'"><h4>'+response[i].Name+ '</h4></a>';
        out += "<p><i>Tác giả</i>: "+response[i].Aut+"<br>";
        if(response[i].Trans!=null) out += "<i>Người dịch</i> : "+response[i].Trans+"<br>";
        out += "<i>Nhà xuất bản</i> : "+response[i].Pub+"<br>";
        out += "<i>Nhà phát hành</i> : "+response[i].Dis+"<br>";
        out += "</div>";
        out += '<div class="col-md-12 col-xs-12 col-sm-8">';
        out += response[i].Des;
        out += "</div></div></div>";
        	document.getElementById("showSearch").innerHTML +=out;
       	//document.getElementById("book"+j+"n").innerHTML=response[i].Name;
    	}
    	
	    out="";
	   }

	   function showTop(response) {
    	var i;
    	var out= "";
    	for(i = 0; i < response.length; i++) {	
	    out += '<div class="row item-center">';
	   out += '<div class="wrap-info">';
	    out +='<a href="'+response[i].Link+'">';
        out += '<img class="my-item book" src="'+ response[i].Img+'" title="'+response[i].Name+'" alt="abc">';
        out += '<div class="info">';
        out += '<p><i>Tác giả</i>: '+response[i].Aut+'<br>';
        if(response[i].Trans!=null)	out += '<i>Người dịch</i> : '+response[i].Trans+'<br>';
        out += '<i>Nhà xuất bản</i> : '+response[i].Pub+'<br>';
        out += '<i>Nhà phát hành</i> : '+response[i].Dis+'<br>';
        out += '</div></a></div>';
        out += '<h4>'+response[i].Name+'</h4></div>';
		}
	    document.getElementById("top").innerHTML +=out;
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