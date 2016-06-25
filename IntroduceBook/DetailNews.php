<?php
	include("login.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Tin Tức</title>

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
			<img src="assets/theme-sach3.jpg" alt="Sách Tiểu Thuyết" style="width:100%">	
		</div>
	</div>

	<!-- Body content -->
	<div class="my-body-container" >
		<div class="col-md-10 col-xs-12 col-sm-9">
			<div class="row">
				<div class="col-md-12 my-title-categories">
					<!-- <h2 class="section-title text-center wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; padding: 0;margin: 0;">Sách nổi bật</h2> -->
					<h2 class="my-title-categories-h2">Tin Tức</h2>
				</div>
			</div>
			<div class="row underline-title">
				<div class="col-md-12 no-pad-mar-underline-title">
					<div class="underline-decoration"></div>
				</div>		
			</div>
			<div id="showNews">

			</div>
			<div class="row" style="margin-top:5em">
				<h2 class="my-title-categories-h2" style="margin-bottom: 20px;">Tin Khác</h2>
				<div id="morenews">
				</div>
  			</div>
		</div>
		<div class="col-md-2 col-xs-8 col-sm-3">
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
	echo $search;
		}

	?>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
<script>
$(document).ready(function(){
	showNews();
	moreNews();
	getTop();	
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
	function showNews() {
		$.ajax({
			url: "GetNews.php?id=<?php if (isset($_GET['id'])) echo $_GET['id']?>",
			type: "GET",
			dataType: "json",
			async:false,
			data: {
				'getNewsDetail' : 1,
			},
			success:function(r) {
					myFunction(r);
				
			}

		});

	}



	function moreNews() {
		$.ajax({
			url: "GetNews.php",
			type: "post",
			dataType: "json",
			async:false,
			data: {
				'getMoreNews' : 1,
			},
			success:function(r) {
					getMoreNews(r);
				
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
    var out="";
    var space ="";
    	out += '<div class="row" style="margin-right:20px;text-align:justify">';
    	out += '<h4>'+response.UPDATED_AT+'</h3>';
    	out += '<h3 style="font-weight:bold">'+response.TITLE+'</h3>';
        out += '<p>'+response.DESCRIPTION+'</p>';
        out += '<img style="display: block;margin-left:auto;margin-right:auto; width:400px; height:550px;" src="'+response.IMAGE_DETAIL +'"  title="' +response.TITLE + '" alt="abc" > ';
        out += response.CONTENT;
        out += '<p style="text-align:right; margin-right:3em">Theo<span style="font-weight:bold"> '+response.SOURCE+'</span></p>';
        out += "</div>";
       	//document.getElementById("book"+j+"n").innerHTML=response[i].Name;
    	
    	document.getElementById("showNews").innerHTML +=out;
	    out="";
	   }

	   function showTop(response) {
    	var i;
    	var out= "";
    	for(i = 0; i < response.length; i++) {	
	    out += '<div class="row item-center">';
	   out += '<div class="wrap-info">';
	    out +='<a href="'+response[i].Link+'">';
        out += '<img class="my-item book" src="'+ response[i].Img+'" title="'+response[i].Name+'" alt="abc" >';
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

    
    

	function getMoreNews(response) {
    	var i;
    	var out='<ul class="custom-bullet">';
    	for(i = 0; i < response.length; i++) {
    	if(response[i].ID != <?php if (isset($_GET['id'])) echo $_GET['id']?>) {
	    	out+= '<li ><a href="DetailNews.php?id=' + response[i].ID+'">';
	    	out+= '<h4 style="margin:0;padding:0;">'+ response[i].Title + '</h4></a></li><br>';
    		}
    	}
    	out+='</ul>';
    	document.getElementById("morenews").innerHTML +=out;
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