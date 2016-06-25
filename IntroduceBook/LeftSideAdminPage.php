<div class="col-md-2 col-nopadding">
	<div class="row account-row">
		<img class="img-thumbnail" style="width: 100px; height: 100px;" 
			<?php 
				if (isset($row)){
					if ($row['AVATAR']!="")
						echo 'src="'.$row['AVATAR'].'"';
					else 
						echo 'src="assets/avatar-default.png"';
				}
				else {
					echo 'src="assets/avatar-default.png"';
				}

			?>
		>
		<h3>
			<?php 
				if (isset($row)){
					echo $row['USERNAME'];
				}
				else {
					echo 'Admin';
				}

			?>
		</h3>
	</div>	
	<div class="row">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		  	<div class="panel panel-default" id="admin-dashboard">
		    	<!-- <div class="panel-heading" role="tab" id="headingOne"> -->
		    	<div class="panel-heading" role="tab" id="headingOne">
		      		<h4 class="panel-title">
			        	<span class="glyphicon glyphicon-home margin-icon" aria-hidden="true"></span>
			        	<a href="AdminDashboard.php?dashboard">
			          		Home
			        	</a>
		      		</h4>
		    	</div>
		  	</div>
			<div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingTwo">
			      	<h4 class="panel-title">
			      		<span class="glyphicon glyphicon-user margin-icon" aria-hidden="true"></span>
				        <a href="AdminManageUsers.php">
				          Users
				        </a>
			      	</h4>
				</div>
		  	</div>
		  	<div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingThree">
			      	<h4 class="panel-title">
			      		<span class="glyphicon glyphicon-book margin-icon" aria-hidden="true"></span>
				        <!-- <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				          Books
				        </a> -->
				        <a href="AdminManageBook.php">
				          Books
				        </a>
			      	</h4>
			    </div>
		    	<!-- <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
			     	<div class="panel-body margin-item-manage">
			     		<p><a href="AdminManageBook.php">Books</a></p>
			     		<p><a href="AdminManageAuthor.php">Authors</a></p>
			     		<p><a href="AdminManageRate.php">Rates</a></p>
			      	</div>
		    	</div> -->
		  	</div>
		  	<div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingFour">
			      	<h4 class="panel-title">
			      		<span class="glyphicon glyphicon-th-list margin-icon" aria-hidden="true"></span>
				        <a href="AdminManageCategories.php">
				          Categories
				        </a>
			      	</h4>
				</div>
		  	</div>
		  	<div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingSix">
			      	<h4 class="panel-title">
			      		<span class="glyphicon glyphicon-pencil margin-icon" aria-hidden="true"></span>
				        <a href="AdminManageAuthors.php">
				          Authors
				        </a>
			      	</h4>
				</div>
		  	</div>
		  	<div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingFive">
			      	<h4 class="panel-title">
			      		<span class="glyphicon glyphicon-comment margin-icon" aria-hidden="true"></span>
				        <a href="AdminManageComments.php">Comments</a>
			      	</h4>
			    </div>
		  	</div>

		  	<!-- <div class="panel panel-default">
			    <div class="panel-heading" role="tab" >
			      	<h4 class="panel-title">
			      		<span class="glyphicon glyphicon-cog margin-icon" aria-hidden="true"></span>
				        <a class="collapsed" >
				          <a href="#">Setting</a>
				        </a>
			      	</h4>
			    </div>
		  	</div> -->

		</div>
	</div>
</div>