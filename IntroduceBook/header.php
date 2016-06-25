<div class="row">
	<div class="col-md-12" style="padding: 0">
		<div class="bg-black"></div>
		<nav class="navbar navbar-default navbar-fixed-top navbar-inverse my-nav-inverse" role="navigation">
			<div class="col-md-1"></div>
			<div class="col-md-11">
				<div class="navbar-header">
					
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse-xam">
						 <span class="sr-only">Toggle navigation</span>
						 <span class="icon-bar"></span>
						 <span class="icon-bar"></span>
						 <span class="icon-bar"></span>
					</button> 

					<a class="navbar-brand " href="Home.php" style="color: white;margin-right: 30px;"><img src="assets/logo_fix.png" alt="BK Book"/></a>
				</div>
				
				<div class="collapse navbar-collapse" id="nav-collapse-xam">
					<ul class="nav navbar-nav">
						<li class="menu-distance">
							<a href="Home.php">Trang chủ</a>
						</li>
						<li class="my-dropdown menu-distance">
						  	<a href='BookCategories.php?Category=KinhTe&page=1' class="my-dropbtn">Sách</a>
						  	<div class="my-dropdown-content">
							    <a href="BookCategories.php?Category=KinhTe&page=1">Kinh tế</a>
							    <a href="BookCategories.php?Category=TruyenTranh&page=1">Truyện tranh</a>
							    <a href="BookCategories.php?Category=VanHocTrongNuoc&page=1">Văn học trong nước</a>
							    <a href="BookCategories.php?Category=VanHocNuocNgoai&page=1">Văn học nước ngoài</a>
						  	</div>
						</li>
						
						<li class="menu-distance">
							<a href="News.php?page=1">Tin tức</a>
						</li>
						<li>
							<a href="Contact.php">Liên hệ</a>
						</li>

						
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="my-dropdown" style="width: 150px;">
						  	<a  
						  		<?php 
						  			if(($_SESSION['userSession'])!="")
									{
										echo "href='UserInfo.php'";
									}
									else {
										echo "href='#'";
										echo 'onclick="'."$('#myModal').css('display','block');"."$('#signupbox').hide();"."$('#loginbox').show()".'"';
									}
								?>>
								<span class="glyphicon glyphicon-user"></span>
								<span> 
									<?php 
										echo ((($_SESSION['userSession'])!="") ? $row['USERNAME'] : 'Tài khoản'); 
									?>
								</span>
							</a>

						  	<div class="my-dropdown-content navbar-right">
						  		<?php
						  			if(($_SESSION['userSession'])!="") {
						  				if($row['ROLE'] == 'Admin' || $row['ROLE'] == 'Super Admin') {
						  					echo '<a href="UserInfo.php"><span class="glyphicon glyphicon-user"></span> Tài khoản</a>
						  						<a href="AdminDashboard.php"><span class="glyphicon glyphicon-pencil"></span> Quản lý</a>
							    				<div class="divider" style="color: white;"></div>
							    				<a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span> Thoát</a>';
						  				}
						  				else {
						  					echo '<a href="UserInfo.php"><span class="glyphicon glyphicon-user"></span> Tài khoản</a>
							    				<div class="divider" style="color: white;"></div>
							    				<a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span> Thoát</a>';
						  				}
						  				
						  			}
						  			else {
						  				echo '<a href="#" id="myBtnLogin" onclick="showModalLogin();"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a>
							    			<a href="#" id="myBtnSignUp" onclick="showModalSignup();"><span class="glyphicon glyphicon-pencil"></span> Đăng ký</a>';

						  			}
					  			?>
						  	</div>
						</li>

					</ul>
					<form class="navbar-form navbar-right my-navbar-form" role="search" method="POST" action="TimKiem.php?page=1">
								<div class="form-group">
									<input type="search" placeholder="Search" name="whatsearch" id="whatsearch" class="form-control" autocomplete="off"/>
									<input type="submit" value ="Search" name="search" style="display: none"/>
									<div id="livesearch">
									</div>
								</div> 
					</form>
				</div>
			</div>
		</nav>
	</div>
</div>