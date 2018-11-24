var cover = document.getElementById('cover');
var signBox = document.getElementById('signBox');
var loginForm = document.getElementById('login');
var signinForm = document.getElementById('signin');
var checked = false;
function toggleOverlay() {
    cover = document.getElementById('cover');
    signBox = document.getElementById('signBox');
    loginForm = document.getElementById('login');
    signinForm = document.getElementById('signup');
    cover.style.opacity = ".5";
    if (true != checked) {
        if ("1" == getCookie("User")) {
            loginForm.style.display = "block";
            signinForm.style.display = "none";
        }
        else {
            loginForm.style.display = "none";
            signinForm.style.display = "block";
        }
        checked = true;
    }
    if (cover.style.display == "block") {
        cover.style.display = "none";
        signBox.style.display = "none";
    }
    else {
        cover.style.display = "block";
        signBox.style.display = "block";
    }
}
function formSwitch() {
    if ("block" == loginForm.style.display) {
        loginForm.style.display = "none";
        signinForm.style.display = "block";
    }
    else {
        loginForm.style.display = "block";
        signinForm.style.display = "none";
    }
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1);
        if (c.indexOf(name) == 0)
            return c.substring(name.length, c.length);
    }
    return "";
}
function validateSignupForm() {
    var signupForm = document.forms[0];
    if (null == signupForm.djName.value || "" == signupForm.djName.value) {
        alert("You must input a DJ Name to continue.");
        signupForm.djName.focus();
        return false;
    }
    if (null == signupForm.legalName.value || "" == signupForm.legalName.value) {
        alert("You must provide a Legal name to continue.");
        signupForm.legalName.focus();
        return false;
    }
    if (null == signupForm.password.value || "" == signupForm.password.value) {
        alert("You must provide a pasword to continue.");
        signupForm.password.focus();
        return false;
    }
    if (null == signupForm.password2.value || "" == signupForm.password2.value) {
        alert("You must retype the password to continue.");
        signupForm.password2.focus();
        return false;
    }
    if (signupForm.password2.value != signupForm.password.value) {
        alert("The passwords do not match try again.");
        signupForm.password2.focus();
        return false;
    }
    if (null == signupForm.city.value || "" == signupForm.city.value) {
        alert("Please provide a City!");
        signupForm.city.focus();
        return false;
    }
    if (null == signupForm.recoveryQ.value || "" == signupForm.recoveryQ.value) {
        alert("Please provide a Recovery Question!");
        signupForm.recoveryQ.focus();
        return false;
    }
    if (null == signupForm.recoveryA.value || "" == signupForm.recoveryA.value) {
        alert("Please provide a Recovery Answer!");
        signupForm.recoveryA.focus();
        return false;
    }
    else {
    }
    return (true);
}
function validateSigninForm() {
    var signinForm = document.forms[1];
    if (null == signinForm.djname.value || "" == signinForm.djname.value) {
        alert("You must input a username to continue.");
        signinForm.djname.focus();
        return false;
    }
    if (null == signinForm.password.value || "" == signinForm.password.value) {
        alert("Please provide a password!");
        signinForm.password.focus();
        return false;
    }
    return (true);
}
