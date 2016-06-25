<?php
	include("dbconnect.php");

	if (isset($_GET['uid'])){
		if (is_numeric($_GET['uid'])) {
			$sql = 'SELECT * FROM users WHERE USER_ID='.$_GET['uid'];
			$retval = $MySQLi_CON->query($sql);
			// $retval = mysqli_query( $dbhandle, $sql );
			if(!$retval )
			{
			  die('Could not get data: ' . mysqli_error());
			}
			$row = $retval->fetch_array();

			$genMale = '';
			$genFemale = '';
			if ($row['GENDER']==1) {
				$genMale = 'checked';
				$genFemale = '';
			}
			else {
				$genFemale = 'checked';
				$genMale = '';
			}
			echo '<div id = "status-userinfo" style="width:60%; margin: 0 0 0 10%;display: none; "></div>
				<fieldset style="width:60%; margin: 0 0 0 10%;">
					<legend><strong>User infomation</strong></legend>
					
					<div class="form-group">
						<label for="uname">
							Username
						</label>
						<input type="text" class="form-control" id="uname" value="'.$row['USERNAME'].'" readonly/>
					</div>
					<div class="form-group">
						<label for="fname">
							Firstname
						</label>
						<input type="text" class="form-control" id="fname" value="'.$row['FIRSTNAME'].'"/>
					</div>
					<div class="form-group">
						<label for="lname">
							Lastname
						</label>
						<input type="text" class="form-control" id="lname" value="'.$row['LASTNAME'].'"/>
					</div>
					<div class="form-group">
						<label for="ubday">
							Birthday
						</label>
						<input type="date" class="form-control" id="ubday" value="'.$row['BIRTHDAY'].'"/>
					</div>
					<div class="form-group">
						<label for="uemail">
							Email
						</label>
						<input type="email" class="form-control" id="uemail" value="'.$row['EMAIL'].'" readonly />
					</div>
					<div class="form-group" style="margin-top: 20px;">
						<label for="gender" style="margin-right: 20px;">
							Gender
						</label>
						<input id="male-gender" type="radio" style="margin: 0px 10px;" name="gender" value="Male" '.$genMale.'>Nam</input>
						<input id="female-gender" type="radio" style="margin: 0px 10px;" name="gender" value="Female" '.$genFemale.'>Nữ</input>
					</div>
					<div class="form-group"> 
						<label for="uphone">
							Phone
						</label>
						<input type="text" class="form-control" id="uphone" value="'.$row['PHONE'].'"/>
					</div>
					<div class="form-group">
						<label for="uaddress">
							Address
						</label>
						<input type="text" class="form-control" id="uaddress" value="'.$row['ADDRESS'].'"/>
					</div>				
					<button onclick="updateUserInfo('.$_GET['uid'].');" class="btn btn-success">
						Update
					</button>
				</fieldset>
				<div id="page-wrapper" style="margin: 20px 0 0 0;">
	                <div class="graphs" style="border-top: 1px solid #ccc;padding:20px 0px;">      
	                    <div class="copy" style="text-align: center;">
	                        <strong style="font-family: LatoFont;font-weight: bold">Copyright &copy; 2016 3D1A'."'".'s Admin All Rights Reserved | Design by <a href="Contact.php" target="_blank">3D1A Team</a> </strong>
	                    </div>
	                </div>       
	            </div>';
			
		}
	}

	

	//close the connection
	$MySQLi_CON->close();

?>