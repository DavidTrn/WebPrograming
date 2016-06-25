// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens login the modal
var btn = document.getElementById("myBtnLogin");

// Get the button that opens signup the modal
var btnSignup = document.getElementById("myBtnSignUp")

// Get the <span> element that closes the modal
var spanSignin = document.getElementsByClassName("close")[0];
var spanSignup = document.getElementsByClassName("close")[1];

// When the user clicks on the button, open the modal 
function showModalLogin() {
    modal.style.display = "block";
    $('#login-alert').css("display","none");
    $('#loginbox').show(); 
    $('#signupbox').hide();
}

function showModalSignup() {
    modal.style.display = "block";
    $('#status-signup').css("display","none");
    $('#loginbox').hide(); 
    $('#signupbox').show();
}

// When the user clicks on <span> (x), close the modal
spanSignin.onclick = function() {
    modal.style.display = "none";
}

spanSignup.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// }