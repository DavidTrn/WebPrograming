<?php
//=================set up connection========================
    $username = "root";
    $password = "";
    $hostname = "localhost";
    
    $dbhandle = mysqli_connect($hostname, $username, $password)
      or die("Unable to connect to mySQL");


//================= select database============================
    $selected = mysqli_select_db($dbhandle,"book_intro")
      or die("Unable to connect to database");
    //echo "database selected<br>";

    mysqli_set_charset($dbhandle,"utf8");

      $type = $_REQUEST['type'];

      if($type == 0)//=========================== update rates ==================
      {
        $id = $_REQUEST['id'];
        $rate = $_REQUEST['rate'];
        $ratenumber = $_REQUEST['point']+1;
        if ($rate == 0) {$sql = "INSERT INTO rates (RATE_ID,BOOK_ID,VERY_GOOD,GOOD,NORMAL,BAD) VALUES ($id,$id,$ratenumber,0,0,0)
              ON DUPLICATE KEY UPDATE VERY_GOOD=$ratenumber";}
        elseif ($rate == 1) {$sql = "INSERT INTO rates (RATE_ID,BOOK_ID,VERY_GOOD,GOOD,NORMAL,BAD) VALUES ($id,$id,0,$ratenumber,0,0)
              ON DUPLICATE KEY UPDATE GOOD=$ratenumber";}
        elseif ($rate == 2) {$sql = "INSERT INTO rates (RATE_ID,BOOK_ID,VERY_GOOD,GOOD,NORMAL,BAD) VALUES ($id,$id,0,0,$ratenumber,0)
              ON DUPLICATE KEY UPDATE NORMAL=$ratenumber";}
        elseif ($rate == 3) {$sql = "INSERT INTO rates (RATE_ID,BOOK_ID,VERY_GOOD,GOOD,NORMAL,BAD) VALUES ($id,$id,0,0,0,$ratenumber)
              ON DUPLICATE KEY UPDATE BAD=$ratenumber";}
        if (mysqli_query($dbhandle,$sql)) {$feedback="Record update successful";}
        else {$feedback="Error: " . $sql . "<br>" . mysqli_error($dbhandle);}
            
             $sql = "SELECT * FROM rates WHERE BOOK_ID=$id";
            $response = $dbhandle->query($sql);
            $result = $response->fetch_array();
            $good = $result['GOOD'];
            $normal = $result['NORMAL'];
            $vgood = $result['VERY_GOOD'];
            $bad = $result['BAD'];
            $sum = $good + $normal + $vgood + $bad;
            $vgoodper = $vgood *100 / $sum;
            $goodper = $good *100 / $sum;
            $normalper = $normal *100 / $sum;
            $badper = $bad *100 / $sum;
            $ratepoint = (3*$vgood + 2*$good + $normal - 2*$bad) / 8;
            $rate = round($ratepoint / 2);
            if ($rate <0) {$rate = 0;}
            elseif ($rate>10) {$rate =10;}
            $out = array("vgoodper"=>$vgoodper,"goodper"=>$goodper,"normalper"=>$normalper,"badper"=>$badper,"rate"=>$rate,"ratenumber"=>$ratenumber,
              "feed"=>$feedback);
        
            echo json_encode($out);

          }
      elseif ($type == 1){//=============================== insert comment ========================
        $id = $_REQUEST['id'];
        $user = $_REQUEST['user'];
        $content = $_REQUEST['content'];
        $content = addslashes($content);
        $sql = "INSERT INTO comments (BOOK_ID, CONTENT, USER_ID) VALUES ($id, '$content', $user)";
        if (mysqli_query($dbhandle, $sql)) {$feedback="Record update successful";}
        else {$feedback="Error: " . $sql . "<br>" . mysqli_error($dbhandle);}

        $sql = "SELECT * FROM users WHERE USER_ID=".$user;
        $response = $dbhandle->query($sql);
        $result = $response->fetch_array();
        $ava = $result['AVATAR'];
        $name = $result['USERNAME'];
        $sql = "SELECT * FROM comments WHERE COMMENT_ID = LAST_INSERT_ID()";
        $response = $dbhandle->query($sql);
        $result = $response->fetch_array();
        $date = $result['CREATED_AT'];
        $out = array("ava"=>$ava,"username"=>$name,"date"=>$date);
        echo json_encode($out);
        
      }
      
      

    mysqli_close($dbhandle);

 ?>