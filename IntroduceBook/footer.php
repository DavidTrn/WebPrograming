<footer>
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-4 col-sm-4 col-xs-6" style="height: 230px;">
                    <h3> Liên lạc </h3>
                    <ul>
                        <li style="margin-bottom: 5px;"><i class=" fa fa-envelope fa-lg"> </i> intro@yourbooks.com </li>
                        <li style="margin-bottom: 5px;"><i class=" fa fa-phone fa-lg"> </i> (+84) 987 654 321 </li>
                        <li style="margin-bottom: 5px;"><i class=" fa fa-map-marker fa-lg"> </i> 268 Lý Thường Kiệt, phường 14, quận 10, thành phố Hồ Chí Minh </li>
                        
                    </ul>
                </div>
                <div class="col-lg-3  col-md-4 col-sm-4 col-xs-6" style="height: 230px;">
                    <h3> Truy cập nhanh </h3>
                    <ul>
                        <li> <a href="BookCategories.php?Category=KinhTe&page=1">Sách Kinh tế </a> </li>
                        <li> <a href="BookCategories.php?Category=TruyenTranh&page=1">Truyện tranh </a> </li>
                        <li> <a href="BookCategories.php?Category=VanHocTrongNuoc&page=1">Văn học trong nước </a> </li>
                        <li> <a href="BookCategories.php?Category=VanHocNuocNgoai&page=1">Văn học nước ngoài </a> </li>
                    </ul>
                </div>

                <div class="col-lg-3  col-md-4 col-sm-4 col-xs-6" style="height: 230px;">
                    <h3> Sách nổi bật </h3>
                    <ul>
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
                                    if ($numbook <= 3) {
                                        echo "<li> <a href=\"DetailBook.php?book_id=".$row['BOOK_ID']."\"> ".$row['BOOK_NAME']. "</a> </li>";
                                    }
                                }
                            }
                        }

                    ?>
                    </ul>
                </div>
                
                <div class="col-lg-3  col-md-12 col-sm-12 col-xs-12" style="height: 230px;">
                    <h3 id="newsletterheader"> Newsletter </h3>
                    <!-- <div id="submailerror" style="color: red;"></div> -->
                    <ul id="newsletterinput">
                        <li>
                            <div class="input-append newsletter-box text-center">
                                <input type="text" id="newstext" class="full text-center" placeholder="Subscribe to receive newsletter... ">
                                <button class="btn" id="newsbtn" type="button" onclick="subscribe();"> Subscribe  <i class="fa fa-long-arrow-right"> </i> </button>
                            </div>
                        </li>
                    </ul>
                    <ul class="social">
                        <li><a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://plus.google.com/
"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <p class="pull-center"> Copyright © YourBooks. Designed by 3D1A TEAM </p>
        </div>
    </div>
</footer>