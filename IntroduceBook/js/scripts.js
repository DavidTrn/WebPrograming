function myLogin() {
	var loginInfo = document.getElementById('login-username').value;
	var pass = document.getElementById('login-password').value;
	var loginremember = document.getElementById("login-remember").checked;//==========

	if(/^[A-Za-z0-9 ]*$/.test(loginInfo) == false) {
		$("#login-alert").html("<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Tên đăng nhập không hợp lệ: không được chứa ký tự đặc biệt!");
		$("#login-alert").css("display","inline-block");
	    return false;
	}
    if (loginInfo.length<2 || loginInfo.length>30) {
    	$("#login-alert").html("<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Tên đăng nhập không hợp lệ: phải nhiều hơn 2 ký tự!");
		$("#login-alert").css("display","inline-block");
        return false;
    }

    if(/['\x22]/.test(pass) == true) {
	    $("#login-alert").html("<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Password không hợp lệ: không được chứa ký tự ' hoặc \" !");
		$("#login-alert").css("display","inline-block");
	    return false;
	}
    if (pass.length<8 || pass.length>30) {
    	$("#login-alert").html("<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Password không hợp lệ: phải nhiều hơn 8 ký tự!");
		$("#login-alert").css("display","inline-block");
        return false;
    }
     
	data = {ulogin:loginInfo, upass:pass, remember:loginremember};

	dataSend = JSON.stringify(data);
	//alert(dataSend);

	$.ajax({
		// The link we are accessing.
		url: "login.php",
			
		// The type of request.
		type: "POST",

		// Data send
		data: dataSend,
			
		// The type of data that is getting returned.
		dataType: "json",

		success: function(jsonData){
			// var json_obj = $.parseJSON(jsonData);//parse JSON

			//alert(jsonData);
			
			if (jsonData.status === 1) {

				location.reload();

				$("#myModal").css("display","none");

			}
			else if (jsonData.status === 0) {
				$("#login-alert").html("<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Email đăng nhập hoặc mật khẩu không đúng!");
				$("#login-alert").css("display","inline-block");
			}
		}
	});
}

function mySignUp() {
	var username = $("#s-username").val();
	var email    = $("#s-email").val();
	var fname    = $("#firstname").val();
	var lname    = $("#lastname").val();
	var pass     = $("#s-password").val();
	var rePass   = $("#icode").val();
	var gender   = 1;
	var pattern = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
	if(/[^[A-Za-z0-9 ]*$/.test(username) == false) {
		$("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Tên đăng nhập không hợp lệ: không được chứa ký tự đặc biệt!</div><br>");
		$("#status-signup").css("display","block");
	    return false;
	}
    if (username.length<2 || username.length>30) {
    	$("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Tên đăng nhập không hợp lệ: phải nhiều hơn 2 ký tự!</div><br>");
		$("#status-signup").css("display","block");
        return false;
    }

    if(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/.test(email) == false) {
		$("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Email không hợp lệ: đây không phải là email!</div><br>");
		$("#status-signup").css("display","block");
	    return false;
	}
	if(pattern.test(fname) == true) {
		$("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Họ không hợp lệ: không được chứa ký tự đặc biệt!</div><br>");
		$("#status-signup").css("display","block");
	    return false;
	}
	if (fname.length<2 || fname.length>30) {
    	$("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Họ không hợp lệ: phải nhiều hơn 2 ký tự!</div><br>");
		$("#status-signup").css("display","block");
        return false;
    }
    if(pattern.test(lname) == true) {
    	$("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Tên không hợp lệ: không được chứa ký tự đặc biệt!</div><br>");
		$("#status-signup").css("display","block");
        return false;
    }
    if (lname.length<2 || lname.length>30) {
    	$("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Tên không hợp lệ: phải nhiều hơn 2 ký tự!</div><br>");
		$("#status-signup").css("display","block");
        return false;
    }

    if (pass !== rePass){
    	$("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Mât khẩu nhập lại và mật khẩu không trùng nhau!</div><br>");
		$("#status-signup").css("display","block");
	    return false;
    }

     if(/['\x22]/.test(pass) == true) {
	    $("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Password không hợp lệ: không được chứa ký tự ' hoặc \" !</div><br>");
		$("#status-signup").css("display","block");
	    return false;
	}
    if (pass.length<8 || pass.length>30) {
    	$("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Password không hợp lệ: phải nhiều hơn 8 ký tự!</div><br>");
		$("#status-signup").css("display","block");
        return false;
    }

    
	if (pass === rePass) {

		if ($('input[name=user-gender]:checked').val() == "Male") {
			gender = 1;
		}
		else {
			gender = 0;
		}
		data = {uname: username, uemail: email, ufname: fname, ulname: lname, upass: pass, ugen:gender};
		dataSend = JSON.stringify(data);

		$.ajax({

			url: "signup.php",

			type: "post",

			data: dataSend,

			dataType: "json",

			success: function(jsonData) {

				if (jsonData.status === 1) {
					$("#status-signup").html("<div class='alert alert-success' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Đăng ký thành công !</div><br>");
					$("#status-signup").css("display","block");
				}
				else if (jsonData.status === 0) {
					$("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Lỗi trong quá trình đăng ký !</div><br>");
					$("#status-signup").css("display","block");
				}
				else if (jsonData.status === 2) {
					$("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Email bạn đăng ký đã tồn tại !</div><br>");
					$("#status-signup").css("display","block");
				}
			}

		});

	}
	else {
		$("#status-signup").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Mật khẩu và mật khẩu nhập lại không khớp !</div><br>");
		$("#status-signup").css("display","block");
	}
}

//================= Dieu  ==================
// function sendmessage(){
// 	var fname = $("#txtname").val();
// 	var email    = $("#txtemail").val();
// 	var subject    = $("#txtsubject").val();
// 	var message    = $("#txtmessage").val();
// 	var pattern = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

// 	if(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/.test(email) == false) {
// 		$("#message-err").html("Email invalid!");
// 		//$("#status-signup").css("display","block");
// 	    return false;
// 	}
// 	if(pattern.test(fname) == true) {
// 		$("#message-err").html("Name invalid: must not contain special character!");
// 		//$("#message-err").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Name invalid: must not contain special character!</div><br>");
// 		//$("#status-signup").css("display","block");
// 	    return false;
// 	}
// 	if (fname.length<2 || fname.length>30) {
// 		$("#message-err").html("Name invalid: must more than 6 character!");
//     	//$("#message-err").html("<div class='alert alert-danger' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Name invalid: must more than 6 character!</div><br>");
// 		//$("#status-signup").css("display","block");
//         return false;
//     }

//  //    data = {name: fname, email: email, subject: subject, message: message};
// 	// dataSend = JSON.stringify(data);
// 	$.ajax({
//         url: "message.php",
//         type: "post",
//         data: {name: fname, email: email, subject: subject, message: message},
//         dataType: "json",
//         success: function( jsonresponse ){
//         	 if (jsonresponse.code === 0){
//         	 	$("#message-err").html("Message send sucessful");
//         	 	$("#message-err").css('color','green');
          		
 
//           	}
//          	 else {
//           		$("#message-err").html("Message send fail");

          	
//           	}
        	
//         	}
//       });

// 	//alert(dataSend);
// 	//======
// }


function subscribe(){
	var mail = document.getElementById('newstext').value;
    var at = mail.indexOf("@");
    var dot = mail.lastIndexOf(".");
    if (at<1 || dot<at+2 || dot+2>=mail.length) {
    	$("#submailerror").html("Invalid Email: wrong email format");
    	$("#newsletterinput").css("margin-top","2px");
    	$("#newsletterheader").css("margin-bottom","2px");
    }
    else {//alert("1");
    	$.ajax({
        url: "subscriber.php?type=1&email="+mail,
        type: "post",
        dataType: "json",
        success: function( jsonresponse ){
        	//alert("1");
        	$("#newsletterinput").css("margin-top","2px");
    		$("#newsletterheader").css("margin-bottom","2px");
          if (jsonresponse.code === 1){
          	$("#submailerror").html("Subscribe sucessful");
 
          }
          else {
          	$("#submailerror").html("Email already subscribed");

          	
          }
          document.getElementById('newstext').value = "";
        }
      });
    }

}

function cancelsub(){
	var mail = document.getElementById('newstext').value;
    var at = mail.indexOf("@");
    var dot = mail.lastIndexOf(".");
    if (at<1 || dot<at+2 || dot+2>=mail.length) {
       $("#submailerror").html("Invalid Email: wrong email format");
    	$("#newsletterinput").css("margin-top","2px");
    	$("#newsletterheader").css("margin-bottom","2px");
    }
    else {
    	$.ajax({
        url: "subscriber.php?type=2&email="+mail,
        type: "post",
        dataType: "json",
        success: function( jsonresponse ){
        	$("#newsletterinput").css("margin-top","2px");
    		$("#newsletterheader").css("margin-bottom","2px");
        	if (jsonresponse.code === 0){
          	$("#submailerror").html("Un-Subscribe sucessful");
          }
          else {
          	$("#submailerror").html("Email not exist");
    		
          	
          }
          document.getElementById('newstext').value = "";
        }
      });
    }

}

 		
// /* If it is left to false the page will try to invalidate the
// * session via an AJAX call
// */
// var validNavigation = false;

// /*
// * Invokes the servlet /endSession to invalidate the session.
// * No HTML output is returned
// */
// function endSession() {
//    $.get("logout.php?logout");
// }

// function wireUpEvents() {

//   /*
//   * For a list of events that triggers onbeforeunload on IE
//   * check http://msdn.microsoft.com/en-us/library/ms536907(VS.85).aspx
//   */
//   window.onbeforeunload = function() {
//       if (!validNavigation) {
//          endSession();
//       }
//   }

//   // Attach the event click for all links in the page
//   $("a").bind("click", function() {
//      validNavigation = true;
//   });

//   // Attach the event submit for all forms in the page
//   $("form").bind("submit", function() {
//      validNavigation = true;
//   });

// }

// // Wire up the events as soon as the DOM tree is ready
// $(document).ready(function() {
//     wireUpEvents();  
// });