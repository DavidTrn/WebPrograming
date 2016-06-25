<?php
    include("login.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contact</title>

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
    ?>
    <div class="row" style="background-color: blue;z-index: 1000;background-image: url(assets/BK_Site.png);">
        <div class="col-md-3 col-sm-4 col-xs-8 col-md-offset-1 col-sm-offset-1 col-xs-offset-1" style="background-color: rgba(0,0,0,0.6);color: white;padding-top: 20px;">
            <div class="contact-form wow fadeInLeftBig animated" style="visibility: visible; animation-name: fadeInLeftBig;">
                <h3>Thông tin liên lạc</h3>

                <address>
                    268 Lý Thường Kiệt, phường 14, <br> Quận 10, thành phố Hồ Chí Minh<br>
                    Phone: 0987 654 321
                </address>
                
                <form id="main-contact-form" name="contact-form" method="post" action="SendMailServerlet.php">
                    <input type='hidden' name='submitted' id='submitted' value='1'/>
                    <div class="form-group">
                        <input type="text" name="txtname" class="form-control" placeholder="Tên" required="" title="Tên chưa được điền">
                    </div>
                    <div class="form-group">
                        <input type="email" name="txtemail" class="form-control" placeholder="Địa chỉ Email" required="" title="Email chưa được điền">
                    </div>
                    <div class="form-group">
                        <input type="text" name="txtsubject" class="form-control" placeholder="Chủ đề" required="" title="Chủ đề chưa được điền">
                    </div>
                    <div class="form-group">
                        <textarea name="txtmessage" class="form-control" rows="8" placeholder="Tin nhắn" required="" title="Nội dung tin nhắn chưa được điền"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="btnSubmit" style="margin: 15px 0;">Gửi tin nhắn</button>
                </form>
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