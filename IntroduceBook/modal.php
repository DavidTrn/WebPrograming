<div id="myModal" class="modal">
	<div class="modal-content">
	  	<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">    <div class="panel panel-info" >
        		<div class="modal-header">
				    <span class="close" style="margin-top: 10px;">×</span>
				    <h3 style="margin: 10px 5px;">Đăng nhập</h3>
			  	</div>    

            	<div style="padding-top:30px" class="panel-body" >

                	<div style="display:none; margin:0px 15px 10px; padding: 5px 5px;" id="login-alert" class="alert alert-danger"></div>
                            
                	<div style="margin: 0px 15px 25px;" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" value="" placeholder="Tên đăng nhập hoặc email" required>                                        
                    </div>
                    
                	<div style="margin: 0px 15px 25px;" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" placeholder="Mật khẩu">
                    </div>
                    <div class="input-group" style="margin: 0px 15px 25px;">
                      	<div class="checkbox">
                            <label>
                              	<input id="login-remember" type="checkbox" value="1"> Giữ tôi đăng nhập
                            </label>
                      	</div>
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        
                        <div class="col-sm-12 controls" style="margin-bottom: 10px;">
                          	<button id="btn-login" class="btn btn-success" onclick="myLogin();">Đăng nhập  </button>
                          	<a id="btn-fblogin" href="#" class="btn btn-primary" onclick="alert('Chức năng đang trong quá trình xây dựng, vui lòng quay lại sau!');">Đăng nhập bằng Facebook</a>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                Không có tài khoản! 
                            	<a href="#" onclick="$('#loginbox').hide(); $('#signupbox').show()">
                                Đăng ký</a>
                            </div>

                            <div style="float:right; font-size: 80%; position: relative; top:-15px"><a href="ResetPassword.php">Quên mật khẩu?</a></div>

                        </div>
                    </div>    
                </div>                     
            </div>  
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
            	<div class="modal-header">
                    <span class="close" style="margin: 5px 0px;">×</span>
				    <h3 style="margin: 10px 5px;">Đăng ký</h3>
				    <div style="float:right; font-size: 85%; position: relative; top:-10px;color: white;">
                        <a style="color:white; text-decoration: none;" id="signinlink" href="#" 
                            onclick="$('#signupbox').hide(); $('#loginbox').show()">Đăng nhập
                        </a>
                    </div>
		  		</div>  
                <div class="panel-body" >
                        
                    <div id = "status-signup" style="display: none; padding: 0px; margin: 0px;"></div>
                        
                    <div class="form-group" style="margin-bottom:20px;">
                        <label for="s-username" class="col-md-4 control-label">Tên đăng nhập</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="s-username" name="s-username" placeholder="Tên đăng nhập">
                        </div>
                    </div>
                    <br>  
                    <div class="form-group" style="margin-bottom:20px;">
                        <label for="s-email" class="col-md-4 control-label">Email</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="s-email" name="s-email" placeholder="Địa chỉ Email">
                        </div>
                    </div>
                    <br>  
                    <div class="form-group" style="margin-bottom:20px;">
                        <label for="firstname" class="col-md-4 control-label">Tên</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Tên">
                        </div>
                    </div>
                    <br>
                    <div class="form-group" style="margin-bottom:20px;">
                        <label for="lastname" class="col-md-4 control-label">Họ</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Họ">
                        </div>
                    </div>
                    <br>
                    <div class="form-group" style="margin-bottom:20px;">
                        <label for="s-password" class="col-md-4 control-label">Mật khẩu</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" id="s-password" name="s-password" placeholder="Mật khẩu">
                        </div>
                    </div>
                    <br>   
                    <div class="form-group" style="margin-bottom:20px;">
                        <label for="icode" class="col-md-4 control-label">Nhập lại mật khẩu</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control"  id="icode" name="icode" placeholder="">
                        </div>
                    </div>
                    <div class="form-group" style="margin:40px 0px 60px;">
                        <label for="user-gender" class="col-md-4 control-label">
                            Giới tính
                        </label>
                        <div class="col-md-8">
                            <input id="male-gen" type="radio" style="margin: 0px 10px;" name="user-gender" value="Male" checked>Nam</input>
                            <input id="female-gen" type="radio" style="margin: 0px 10px;" name="user-gender" value="Female" >Nữ</input>
                        </div>
                    </div>
                    <br>
                    <div class="form-group" style="margin-bottom:25px;">                                      
                        <div class="col-md-offset-4 col-md-8">
                            <button id="btn-signup" class="btn btn-info" onclick="mySignUp();"><i class="icon-hand-right"></i> &nbsp; Đăng ký</button>
                            <span style="margin-left:8px;">hoặc</span>  
                        </div>
                    </div>
                    <br>
                    <div style="border-top: 1px solid #999; padding-top:10px"  class="form-group">
                        
                        <div class="col-md-offset-4 col-md-8">
                            <button id="btn-fbsignup" type="button" class="btn btn-primary" onclick="alert('Chức năng đang trong quá trình xây dựng, vui lòng quay lại sau!');"><i class="icon-facebook"></i>   Đăng nhập bằng Facebook</button>
                        </div>                                           
                            
                    </div>   
                </div>
            </div>     
         </div>
	</div>
</div>