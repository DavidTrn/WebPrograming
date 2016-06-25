<div class="row">
	<div class="col-md-12" style="padding: 0">
		<div class="bg-black" style="margin-bottom: 30px;"></div>
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
					<a class="navbar-brand " href="Home.php" style="color: white;"><img src="assets/logo_fix.png" alt="BK Book"/></a>
				</div>
				
				<div class="collapse navbar-collapse" id="nav-collapse-xam">
					<ul class="nav navbar-nav navbar-right">

						<li class="my-dropdown" style="width: 150px;">
						  	<a  <?php echo "href='UserInfo.php'";?> >
								<span class="glyphicon glyphicon-user"></span>
								<span> 
									<?php 
										echo ((isset($_SESSION['userSession'])!="") ? $row['USERNAME'] : 'Tài khoản'); 
									?>
								</span>
							</a>

						  	<div class="my-dropdown-content navbar-right">
						  		<?php
						  			if(isset($_SESSION['userSession'])!="") {
						  				echo '<a href="UserInfo.php"><span class="glyphicon glyphicon-user"></span>Tài khoản</span></a>
							    			<div class="divider" style="color: white;"></div>
							    			<a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span> Thoát</a>';
						  			}
						  			else {
						  				echo '<a href="#" id="myBtnLogin" onclick="showModalLogin();"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a>
							    			<a href="#" id="myBtnSignUp"
							    			onclick="showModalSignup();"><span class="glyphicon glyphicon-pencil"></span> Đăng ký</a>';

						  			}
					  			?>
						  	</div>
						</li>

					</ul>
				</div>
			</div>
		</nav>
	</div>
</div>