<?php
if (isset($_GET['book_id'])){
  $BookID = $_GET['book_id'];
} 

//=================set up connection========================
//================= select database============================
  include("login.php");
  include('dbconnect.php');

//===================== get corpus ======================
    $query = "SELECT * FROM books WHERE BOOK_ID=".$BookID;
    $response = $MySQLi_CON->query($query);
    $resultbook =$response->fetch_array();

    $query1 = "SELECT * FROM authors WHERE AUTHOR_ID=".$resultbook['AUTHOR_ID'];
    $response1 = $MySQLi_CON->query($query1);
    $resultauthor = $response1->fetch_array();

    $query2 = "SELECT * FROM rates WHERE BOOK_ID=".$BookID;
    $response2 = $MySQLi_CON->query($query2);
    $resultrate = $response2->fetch_array();

    $query3 = "SELECT * FROM comments WHERE BOOK_ID=".$BookID;
    $response3 = $MySQLi_CON->query($query3);
   
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $resultbook['BOOK_NAME']; ?></title>

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

  <!--======================== Body content ========================-->
  <div class="row" style="margin: 50px 50px 50px 0px;">
   
    
    <div class="col-md-1"></div>
    <div class="col-md-9">

      <!--======================== main ========================-->
      <div class="row">
        <div class="col-xs-12 col-sm-5 col-md-4">
          <a href="#" class="thumbnail my-thumbnail">
            <img src=<?php echo $resultbook['IMAGE']; ?> alt=<?php echo $resultbook['IMAGE']; ?> >
          </a>
        </div>
        <div class="col-xs-12 col-sm-7 col-md-7">
          <div class="row">
            <h3 style="margin: 0; padding: 0;font-weight: bold;"><?php echo $resultbook['BOOK_NAME']; ?></h3>
          </div>
          <div class="row">
            <div class="col-xs-6 col-md-6">
              <h4>Tác giả</h4>
              <a href="https://vi.wikipedia.org/wiki/Thomas_Friedman"><p style="color: blue;padding-left: 20px;"><?php echo $resultauthor['AUTHOR_NAME']; ?></p></a>
              <h4>Thể loại</h4>
              <p style="color: blue;padding-left: 20px;"><?php echo $resultbook['CATEGORY_NAME']; ?></p>
              <h4>Nhà xuất bản</h4>
              <p style="color: blue;padding-left: 20px;"><?php echo $resultbook['PUBLISHER']; ?></p>
            </div>
            <div class="col-xs-6 col-md-6">
              <?php 
                if(isset($resultbook['TRANSLATOR'])) {$translator = "<h4>Người dịch</h4>
                  <p style=\"color: blue;padding-left: 20px;\">";
                  $translator.= $resultbook['TRANSLATOR'];
                  $translator.= "</p>";
                  echo $translator;}
                else {}
              ?>
              <h4>Sách có bán tại</h4>
              <p style="color: blue;padding-left: 20px;"><a href="http://fahasasg.com.vn/"><?php echo $resultbook['SELL_AT']; ?></a></p>
            </div>
          </div>
          <div class="row more">
            <?php echo $resultbook['DISCRIPTION']; ?>
          </div>
        </div>
        <div class="col-xs-6 col-md-1" ></div>
      </div>
      <!--======================== intro - author - rate - comment ========================-->
      <div class="row">
      <div class="col-md-10" style="padding-top: 50px">
        <ul class="nav nav-tabs">
          <li class="active">
            <a data-toggle="tab" href="#introduce">
              Giới thiệu sách
            </a>
          </li>
          <li>
            <a data-toggle="tab" href="#author">
              Tác giả
            </a>
          </li>
          <li>
            <a data-toggle="tab" href="#rate">
              Đánh giá
            </a>
          </li>
          <li>
            <a data-toggle="tab" href="#comment">
              Bình luận
            </a>
          </li>
        </ul>

        <div class="tab-content">
          <!--========************** Intro ************========================-->
          <div id="introduce" class="tab-pane fade in active">
            <br>
            
            <?php echo $resultbook['DISCRIPTION']; ?>

          </div>
          <!--=========************** Author ************===============-->
          <div id="author" class="tab-pane fade">
          <br>
            <div class="row">
              <div class="col-md-8 col-xs-6">
                <?php echo $resultauthor['INTRODUCE']; ?>
              </div>
              <div class="col-md-4 col-xs-6">
                <a class="thumbnail">
                  <img src=<?php echo ((($resultauthor['IMAGE'])!="") ? $resultauthor['IMAGE'] : '"assets/avatar-default.png"') ?> alt=<?php echo ((isset($resultauthor['IMAGE'])!="") ? $resultauthor['IMAGE'] : '"alt"') ?> >
                </a>
              </div>
            </div>
          </div>
          <!--=========************** Rate ************=================-->
          <div id="rate" class="tab-pane fade">
          <?php
            $good = $resultrate['GOOD'];
            $normal = $resultrate['NORMAL'];
            $vgood = $resultrate['VERY_GOOD'];
            $bad = $resultrate['BAD'];
            $sum = $good + $normal + $vgood + $bad;
            if ($sum == 0) {
               $vgoodper = 0;
            $goodper = 0;
            $normalper = 0;
            $badper = 0;
            }
            else { $vgoodper = "'width: ".$vgood *100 / $sum."%'";
            $goodper = "'width: ".$good *100 / $sum."%'";
            $normalper = "'width: ".$normal *100 / $sum."%'";
            $badper = "'width: ".$bad *100 / $sum."%'";}
           
            $ratepoint = (3*$vgood + 2*$good + $normal - 2*$bad) / 8;
            $rate = round($ratepoint / 2);
            if ($rate <0) {$rate = 0;}
            elseif ($rate>10) {$rate =10;}
          ?>
            <div class="row">
              <div class="col-md-7 col-sm-12 col-xs-12" style="margin: 5px;">
                <h3>
                    Đánh giá về sách
                </h3>
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-3 my-rate">
                    <span>
                      Rất hay:
                    </span>
                  </div>
                  <div class="col-md-6 col-sm-8 col-xs-7 my-rate">
                    <div class="progress" style="width:100%">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style=<?php echo $vgoodper; ?> id="vgoodrate">
                        <span id="verygood"><?php echo $vgood; ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-1 col-xs-2">
                    <button type="button" id="vgoodbtn" data-bookid=<?php echo $resultbook['BOOK_ID']; ?> data-point=<?php echo $vgood; ?> data-response="verygood" class="btn btn-default">
                      <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-3 my-rate my-rate">
                    <span>
                      Hay:
                    </span>
                  </div>
                  <div class="col-md-6 col-sm-8 col-xs-7 my-rate">
                    <div class="progress" style="width:100%">
                      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style=<?php echo $goodper; ?> id="goodrate">
                        <span id="good"><?php echo $good; ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-1 col-xs-2">
                    <button type="button" id="goodbtn" data-bookid=<?php echo $resultbook['BOOK_ID']; ?> data-point=<?php echo $good; ?> data-response="good" class="btn btn-default">
                      <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-3 my-rate my-rate">
                    <span>
                      Bình thường:
                    </span>
                  </div>
                  <div class="col-md-6 col-sm-8 col-xs-7 my-rate">
                    <div class="progress" style="width:100%">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style=<?php echo $normalper; ?> id="normalrate">
                        <span id="normal"><?php echo $normal; ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-1 col-xs-2">
                    <button type="button" id="normalbtn" data-bookid=<?php echo $resultbook['BOOK_ID']; ?> data-point=<?php echo $normal; ?> data-response="normal" class="btn btn-default">
                      <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-3 my-rate my-rate">
                    <span>
                      Không hay:
                    </span>
                  </div>
                  <div class="col-md-6 col-sm-8 col-xs-7 my-rate">
                    <div class="progress" style="width:100%">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style=<?php echo $badper; ?> id="badrate">
                        <span id="bad"><?php echo $bad; ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-1 col-xs-2">
                    <button type="button" id="badbtn" data-bookid=<?php echo $resultbook['BOOK_ID']; ?> data-point=<?php echo $bad; ?> data-response="bad" class="btn btn-default">
                      <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </button>
                  </div>
                </div>

              </div>

              <div class="col-md-5 col-sm-12 col-xs-12"></div>
                <div style="text-align: center;" id="ratepoint">
                  <h3>Điểm</h3>
                  <h2>
                    <?php echo $rate/2;?>/5
                  </h2>
                  <?php 
                    for ($i = 1; $i < $rate; $i= $i+2){
                      echo "<img src='assets/Star-icon.png' alt='star'>";
                    }
                    if ($rate%2==1) echo "<img src='assets/Star-half-icon.png' alt='half-star'>";
                    for ($i = 1;$i < 10-$rate; $i= $i+2){
                      echo "<img src='assets/nonfill-star-icon.png' alt='nonfill-star-icon'>";
                    }
                  ?>
                </div>

            </div>
          </div>
          <!--=======************** Comment ************=======-->
          <div id="comment" class="tab-pane fade">
            <div class="detailBox">
                <!-- <div class="titleBox">
                  <label>Comment Box</label>
                </div> -->
                <div class="commentBox">

                    <p class="taskDescription">Bình luận của người đọc</p>
                </div>
                <div class="actionBox">
                    <ul id="commentul" class="commentList">
                    <?php 
                      while ($resultcomm = $response3->fetch_array()){
                        $comm = $resultcomm['CONTENT']; 
                        $date = $resultcomm['CREATED_AT']; 

                        $query4 = "SELECT * FROM users WHERE USER_ID=".$resultcomm['USER_ID'];
                        $response4 = $MySQLi_CON->query($query4);
                        $resultuser = $response4->fetch_array();
                        $avatar = ((isset($resultuser['AVATAR'])!="") ? $resultuser['AVATAR'] : "assets/avatar-default.png") ;
                        $name = $resultuser['USERNAME'];
                        echo "<li>
                            <div class='commenterImage'>";
                        echo "<img src=".$avatar." alt='avatar'/>";
                        echo  "</div>
                            <div class='commentText'>
                                <p class=''><strong>".$name."</strong></p>
                                <p class=''>".$comm."</p> <span class='date sub-text'>".$date."</span>
                            </div>
                        </li>";
                      }
                    ?>    
                      
                        
                    </ul>
                    <form name="commentform" class="form-inline">
                        <div class="form-group">
                            <input name="content" class="form-control" type="text" placeholder="Your comments" />
                            <input type="hidden" name="bookid" value=<?php echo $BookID; ?>>
                            <!-- <input type="hidden" name="userid" value=<?php echo $BookID; ?>> -->
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="session" value=<?php if (isset($_SESSION['userSession'])) echo $_SESSION['userSession']; ?>>
                            <input id="addcomm" class="btn btn-primary" value="Add">
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      <!--===================== similar book ============================-->
      <?php
          $query5 = "SELECT * FROM books WHERE CATEGORY_ID=\"".$resultbook['CATEGORY_ID']."\"";
          $response5 = $MySQLi_CON->query($query5);
          $similarbook = array();
          for ($i=0; $i<4; $i++){
            $resultsimilar = $response5->fetch_array();
            if ($resultsimilar['BOOK_ID']==$BookID) {$resultsimilar = $response5->fetch_array();}
            if ($resultsimilar['BOOK_ID']==""){ break;}
            $similarbook[] = array("img"=>$resultsimilar['IMAGE'],"name"=>$resultsimilar['BOOK_NAME'],"dis"=>$resultsimilar['DISCRIPTION'],"id"=>$resultsimilar['BOOK_ID']);
          }
          if ($i==0) {$display = "none";}
          else {$display = "block";}
      ?>
      <div class="row" id="similarbook" style="display: <?php echo $display; ?>">
        <h3>Sách cùng thể loại</h3>
        <hr>
        <?php          
          for ($j=0; $j<$i; $j++){
            echo "<div class=\"col-sm-6 col-md-3\">
                  <div class=\"thumbnail\">
                    <img src=\"".$similarbook[$j]['img']."\" alt=\"".$similarbook[$j]['img']."\" style=\"width:200px; height:280px;\">";
            echo "<div class=\"hoverButton\">
              <div class=\"hoverButton_top\"> 
                <a href=\"DetailBook.php?book_id=".$similarbook[$j]['id']."\">
              <button type=\"button\" class=\"btn btn-primary\">Đọc tiếp</button></a></div>
              <div class=\"hoverButton_bottom\"> </div>
            </div>
            <div class=\"caption\">";
            echo "<h4 style='text-align:center;'><strong>".$similarbook[$j]['name']."</strong></h4>";
            echo "<div class=\"more1\">".$similarbook[$j]['dis']."</div>";
            echo "</div>
                  </div>
                  </div>";

          }
        ?>
      </div>
      <div class="row" style="display: <?php echo $display; ?>">
        <div class="col-md-10"></div>
        <div class="col-md-1">
          <a href="BookCategories.php?Category=<?php echo $resultbook['CATEGORY_CODE']; ?>&page=1">
          <button type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> Xem tiếp
          </button>
          </a>

        </div>
      </div>
      <!--===================== recommended book =====================-->
      <?php
          $query5 = "SELECT * FROM books WHERE TYPE='Highlight'";
          $response5 = $MySQLi_CON->query($query5);
          $recommendedbook = array();
          for ($i=0; $i<4; $i++){
            $resultsimilar = $response5->fetch_array();
            if ($resultsimilar['BOOK_ID']==$BookID) $resultsimilar = $response5->fetch_array();
            if ($resultsimilar['BOOK_ID']==""){ break;}
            $recommendedbook[] = array("img"=>$resultsimilar['IMAGE'],"name"=>$resultsimilar['BOOK_NAME'],"dis"=>$resultsimilar['DISCRIPTION'],"id"=>$resultsimilar['BOOK_ID']);
          }
          if ($i==0) {$display = "none";}
          else {$display = "block";}
      ?>
      <div class="row" id="recombook" style="display: <?php echo $display; ?>">
        <h3>Có thể bạn sẽ thích</h3>
        <hr>
        <?php
          for ($j=0; $j<$i; $j++){
            echo "<div class=\"col-sm-6 col-md-3\">
                  <div class=\"thumbnail\">
                    <img src=\"".$recommendedbook[$j]['img']."\" alt=\"".$recommendedbook[$j]['img']."\" style=\"width:200px; height:280px;\">";
            echo "<div class=\"hoverButton\">
              <div class=\"hoverButton_top\"> 
              <a href=\"DetailBook.php?book_id=".$recommendedbook[$j]['id']."\">
              <button type=\"button\" class=\"btn btn-primary\">Đọc tiếp</button></a></div>
              <div class=\"hoverButton_bottom\"> </div>
            </div>
            <div class=\"caption\">";
            echo "<h4 style='text-align:center;'><strong>".$recommendedbook[$j]['name']."</strong></h4>";
            echo "<div class=\"more1\">".$recommendedbook[$j]['dis']."</div>";
            echo "</div>
                  </div>
                  </div>";

          }
        ?>
      </div>

    <!-- <div class="row" style="display: <?php echo $display; ?>">
        <div class="col-md-10"></div>
        <div class="col-md-1">
          <a href="BookCategories.php?Category=<?php echo $resultbook['CATEGORY']; ?>&page=1">
          <button type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> Xem tiếp
          </button>
          </a>
        </div>
      </div> -->
     
    </div>
    <!--============================ right panel ===================================-->
    <?php
          $query6 = "SELECT * FROM books WHERE AUTHOR_ID=\"".$resultbook['AUTHOR_ID']."\"";
          $response6 = $MySQLi_CON->query($query6);
          $rightpanelbook = array();
          for ($i=0; $i<3; $i++){
            $resultsimauthor = $response6->fetch_array();
            if ($resultsimauthor['BOOK_ID']==$BookID) {$resultsimauthor = $response6->fetch_array();}
            if ($resultsimauthor['BOOK_ID']==""){ break;}
            $rightpanelbook[] = array("img"=>$resultsimauthor['IMAGE'],"name"=>$resultsimauthor['BOOK_NAME'],"id"=>$resultsimauthor['BOOK_ID']);
          }
          if ($i==0) {$display = "none";}
          else {$display = "block";}
      ?>
    <div class="col-md-2" style="display: <?php echo $display; ?>">
      <h3 style="padding: 0;">Cùng tác giả</h3>
        <?php
    for ($j=0; $j<$i; $j++){
            echo "<div style=\"text-align:center;\">
                  <a href=\"DetailBook.php?book_id=".$rightpanelbook[$j]['id']."\">
                    <img src=\"".$rightpanelbook[$j]['img']."\" alt=\"".$rightpanelbook[$j]['img']."\" style=\"width:200px; height:280px;\">";
            echo "<h4>".$rightpanelbook[$j]['name']."</h4>";
            echo "</a>
                  </div>";

          }
        ?>
    </div>
  </div>
</div>
  <!--============================ footer ===================================-->
<?php
  include('footer.php');
?>
<script src="js/modal-scripts.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#vgoodbtn").click(function(){
      var bookid = $(this).data('bookid');
      var point = $(this).data('point');
       $.ajax({
        url: "BookDetailProcess.php?type=0&rate=0&id="+bookid+"&point="+point,
        type: "get",
        dataType: "json",
        success: function( jsonresponse ){
          $("#verygood").html(jsonresponse.ratenumber);
          $('#vgoodrate').css({"width":jsonresponse.vgoodper+"%"});
          $('#goodrate').css({'width':jsonresponse.goodper+'%'});
          $('#normalrate').css({'width':jsonresponse.normalper+'%'});
          $('#badrate').css({'width':jsonresponse.badper+'%'});
          var i=0;
          var ratepoint = "<h3>Điểm</h3><h2>"+jsonresponse.rate/2+"/5</h2>";
          for (i = 1; i < jsonresponse.rate; i= i+2){
            ratepoint += "<img src='assets/Star-icon.png' alt='star'>";
          }
          if (jsonresponse.rate%2==1) {ratepoint +="<img src='assets/Star-half-icon.png' alt='half-star'>";}
          for (i = 1;i < 10-jsonresponse.rate; i= i+2){
              ratepoint += "<img src='assets/nonfill-star-icon.png' alt='nonfill-star-icon'>";
          }
          $('#ratepoint').html(ratepoint);  
        }
      });
       disablebtn();
    });

    $("#goodbtn").click(function(){
      var bookid = $(this).data('bookid');
      var point = $(this).data('point');
       $.ajax({
        url: "BookDetailProcess.php?type=0&rate=1&id="+bookid+"&point="+point,
        type: "get",
        dataType: "json",
        success: function( jsonresponse ){
          $("#good").html(jsonresponse.ratenumber);
          $('#vgoodrate').css({"width":jsonresponse.vgoodper+"%"});
          $('#goodrate').css({'width':jsonresponse.goodper+'%'});
          $('#normalrate').css({'width':jsonresponse.normalper+'%'});
          $('#badrate').css({'width':jsonresponse.badper+'%'});
          var i=0;
          var ratepoint = "<h3>Điểm</h3><h2>"+jsonresponse.rate/2+"/5</h2>";
          for (i = 1; i < jsonresponse.rate; i= i+2){
            ratepoint += "<img src='assets/Star-icon.png' alt='star'>";
          }
          if (jsonresponse.rate%2==1) {ratepoint +="<img src='assets/Star-half-icon.png' alt='half-star'>";}
          for (i = 1;i < 10-jsonresponse.rate; i= i+2){
              ratepoint += "<img src='assets/nonfill-star-icon.png' alt='nonfill-star-icon'>";
          }
          $('#ratepoint').html(ratepoint);
        }
      });
       disablebtn();
    });

    $("#normalbtn").click(function(){
      var bookid = $(this).data('bookid');
      var point = $(this).data('point');
       $.ajax({
        url: "BookDetailProcess.php?type=0&rate=2&id="+bookid+"&point="+point,
        type: "get",
        dataType: "json",
        success: function( jsonresponse ){
         $("#normal").html(jsonresponse.ratenumber);
          $('#vgoodrate').css({"width":jsonresponse.vgoodper+"%"});
          $('#goodrate').css({'width':jsonresponse.goodper+'%'});
          $('#normalrate').css({'width':jsonresponse.normalper+'%'});
          $('#badrate').css({'width':jsonresponse.badper+'%'});
          var i=0;
          var ratepoint = "<h3>Điểm</h3><h2>"+jsonresponse.rate/2+"/5</h2>";
          for (i = 1; i < jsonresponse.rate; i= i+2){
            ratepoint += "<img src='assets/Star-icon.png' alt='star'>";
          }
          if (jsonresponse.rate%2==1) {ratepoint +="<img src='assets/Star-half-icon.png' alt='half-star'>";}
          for (i = 1;i < 10-jsonresponse.rate; i= i+2){
              ratepoint += "<img src='assets/nonfill-star-icon.png' alt='nonfill-star-icon'>";
          }
          $('#ratepoint').html(ratepoint);
        }
      });
       disablebtn();
    });

    $("#badbtn").click(function(){
      var bookid = $(this).data('bookid');
      var point = $(this).data('point');
       $.ajax({
        url: "BookDetailProcess.php?type=0&rate=3&id="+bookid+"&point="+point,
        type: "get",
        dataType: "json",
        success: function( jsonresponse ){
          $("#bad").html(jsonresponse.ratenumber);
          $('#vgoodrate').css({"width":jsonresponse.vgoodper+"%"});
          $('#goodrate').css({'width':jsonresponse.goodper+'%'});
          $('#normalrate').css({'width':jsonresponse.normalper+'%'});
          $('#badrate').css({'width':jsonresponse.badper+'%'});
          var i=0;
          var ratepoint = "<h3>Điểm</h3><h2>"+jsonresponse.rate/2+"/5</h2>";
          for (i = 1; i < jsonresponse.rate; i= i+2){
            ratepoint += "<img src='assets/Star-icon.png' alt='star'>";
          }
          if (jsonresponse.rate%2==1) {ratepoint +="<img src='assets/Star-half-icon.png' alt='half-star'>";}
          for (i = 1;i < 10-jsonresponse.rate; i= i+2){
              ratepoint += "<img src='assets/nonfill-star-icon.png' alt='nonfill-star-icon'>";
          }
          $('#ratepoint').html(ratepoint);
        }
      });
       disablebtn();
    });

    $("#addcomm").click(function(){
      var session = document.forms['commentform']['session'].value;
      if (session=="") {//alert("dang nhap");
      $("#myModal").css('display','block');
      $("#signupbox").hide();
      $("#loginbox").show();
      }
      else {
      var content = document.forms['commentform']['content'].value;
      var bookid = document.forms['commentform']['bookid'].value;
      //var userid = document.forms['commentform']['userid'].value;
       $.ajax({
        url: "BookDetailProcess.php?type=1&id="+bookid+"&user="+session+"&content="+content,
        type: "post",
        dataType: "json",
        success: function( jsonresponse ){
          //alert(jsonresponse.ava);
          var add = "<li><div class=\"commenterImage\"><img src=";
          if (jsonresponse.ava==null) add += "'assets/avatar-default.png'"; else add += jsonresponse.ava;
          add +=" alt=\"avatar\"/>";
          add +=" </div> <div class=\"commentText\"><p class=\"\"><strong>"+jsonresponse.username+"</strong></p><p class=\"\">";
          add += content;
          add += "</p> <span class=\"date sub-text\">";
          add += jsonresponse.date;
          add += "</span></div></li>";
          $("#commentul").append(add);
          document.forms['commentform']['content'].value="";
        }
      });}
    });

    
    $('.more').each(function() {
      var showChar = 600;
      var content = $(this).html();

      if(content.length > showChar) {

        var c = content.substr(0, showChar);
        var html = c + "...&nbsp;<a href=\"#introduce\">Đọc tiếp</a>";

        $(this).html(html);
      } 
    });

    $('.more1').each(function() {
      var showChar = 230;
      var content = $(this).html();

      if(content.length > showChar) {

        var c = content.substr(0, showChar);
        var html = c + "...";

        $(this).html(html);
      } 
    });

  });

  function disablebtn(){
    $("#vgoodbtn").attr("disabled", true);
    $("#goodbtn").attr("disabled", true);
    $("#normalbtn").attr("disabled", true);
    $("#badbtn").attr("disabled", true);
  }
 
</script>
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
<?php //========================= end database connection===================== 
  $MySQLi_CON->close();
?>
</body>
</html>
