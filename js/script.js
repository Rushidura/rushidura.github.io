function changeView(){
    var signInBox = document.getElementById("signInBox");
    var signUpBox = document.getElementById("signUpBox");

    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");
}
function signup(){
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("m", mobile.value);
    form.append("g", gender.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200){
            var response = request.responseText;
            if(response == "success"){
                document.getElementById("msg").innerHTML = "Registration Successful";
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
                changeView();
            }else{
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    }

    request.open("POST","signUpProcess.php",true);
    request.send(form);
}
function signIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberMe = document.getElementById("rememberMe");

    var form = new FormData();
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("r", rememberMe.checked);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200){
            var response = request.responseText;
            // alert(response);
            if(response == "success"){
                document.getElementById("msg1").innerHTML = "Login Successful";
                document.getElementById("msg1").className = "alert alert-success";
                document.getElementById("msgdiv1").className = "d-block";
                window.location.href = "home.php";
            }else{
                document.getElementById("msg1").innerHTML = response;
                document.getElementById("msgdiv1").className = "d-block";
            }
        }
    }
    request.open("POST","signInProcess.php",true);
    request.send(form);
}

var forgotPasswordModal;


function forgotPassword(){
    var email = document.getElementById("email2");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                alert("Verification code has sent successfully to your email.");
                var modal = document.getElementById("fpmodal");
                forgotPasswordModal = new bootstrap.Modal(modal);
                forgotPasswordModal.show();
            }else{
                document.getElementById("msg1").innerHTML = response;
                document.getElementById("msgdiv1").className = "d-block";
            }
        }
    }

    request.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    request.send();
}

function showPassword1(){
    // alert("OK");
    var textField = document.getElementById("np");
    var button = document.getElementById("npb");

    if (textField.type == "password"){
        textField.type = "text";
        button.innerHTML = "<i class='bi bi-eye'></i>";
    }else{
        textField.type = "password";
        button.innerHTML = "<i class='bi bi-eye-slash'></i>";

    }
}

function showPassword2(){
    // alert("OK");
    var textField = document.getElementById("rp");
    var button = document.getElementById("rpb");

    if (textField.type == "password"){
        textField.type = "text";
        button.innerHTML = "<i class='bi bi-eye'></i>";
    }else{
        textField.type = "password";
        button.innerHTML = "<i class='bi bi-eye-slash'></i>";
    }
}
function resetPassword(){
    var email = document.getElementById("email2");
    var newPassword = document.getElementById("np");
    var retypedPassword = document.getElementById("rp");
    var Verifcationcode = document.getElementById("vccode");

    var form = new FormData();
    form.append("e", email.value);
    form.append("np", newPassword.value);
    form.append("rp", retypedPassword.value);
    form.append("v", Verifcationcode.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200){
            var response = request.responseText;
            if (response == "success") {
                alert("Password Update successfully.");
                forgotPasswordModal.hide();
            } else{
                alert(response);
            }
        }
    }
    request.open("POST","resetPasswordProcess.php",true);
    request.send(form);
}
function signout(){
    // alert("Please");
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200){
            var response = request.responseText;
            if(response == "success"){
                window.location.reload();    
            }
        }
    }
    request.open("POST","signOutProcess.php",true);
    request.send();
}
function showPassword3(){
    // alert("Please");

    var pw = document.getElementById("pw");
    var pwicon = document.getElementById("pwi");

    if(pw.type == "password"){
        pw.type = "text";
        pwicon.className = "bi bi-eye-fill text-white";
    }else{
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash-fill text-white";
    }
}
function selectDistrict(){
        var province_id = document.getElementById("province").value;

        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200){
                var response = request.responseText;
                document.getElementById("district").innerHTML = response;
                // alert(response)
            }
        }
        request.open("GET","selectDistrictProcess.php?id="+province_id,true);
        request.send();
}

function selectdistrict(){
    var district_id = document.getElementById("district").value;

        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200){
                var response = request.responseText;
                document.getElementById("city").innerHTML = response;
                // alert(response)
            }
        }
        request.open("GET","selectCityProcess.php?id="+district_id,true);
        request.send();
}